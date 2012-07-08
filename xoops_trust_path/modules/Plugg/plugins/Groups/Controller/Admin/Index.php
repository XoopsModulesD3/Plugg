<?php
class Plugg_Groups_Controller_Admin_Index extends Plugg_Form_Controller
{
    protected function _doGetFormSettings(Sabai_Request $request, Sabai_Application_Response $response, array &$formStorage)
    {
        $form = array(
            'groups' => array(
                '#type' => 'tableselect',
                '#header' => array('icon' => ''),
                '#multiple' => true,
                '#js_select' => true,
                '#options' => array(),
            )
        );
        
        $sortable_headers = array(
            'display_name' => $this->_('Name'),
            'created' => $this->_('Created'),
            'type' => $this->_('Type'),
            'member_count' => $this->_('Members'),
        );
        $sort = $request->asStr('sort', 'created', array_keys($sortable_headers));
        $order = $request->asStr('order', 'DESC', array('ASC', 'DESC'));
        $path = '/groups';
        
        // Add headers
        foreach ($sortable_headers as $header_name => $header_label) {
            $attr = array('title' => sprintf($this->_('Sort by %s'), $header_label));    
            if ($sort === $header_name) {
                $url_params = array('sort' => $header_name, 'order' => $order == 'ASC' ? 'DESC' : 'ASC');
                $attr['class'] = 'plugg-' . strtolower($order);
            } else {
                $url_params = array('sort' => $header_name, 'order' => 'ASC');
            }
            $form['groups']['#header'][$header_name] = $this->LinkToRemote(
                $header_label,
                'plugg-content',
                $this->getUrl($path, $url_params),
                array(),
                array(),
                $attr
            );
        }
        $form['groups']['#header']['links'] = '';
        
        // Add rows (options)
        $pages = $this->getPluginModel()->Group->criteria()
            ->status_is(Plugg_Groups_Plugin::GROUP_STATUS_APPROVED)->paginate(20, $sort, $order);
        $groups = $pages->getValidPage($request->asInt('p', 1))->getElements();
        foreach ($groups->with('User') as $group) {
            $group_path = $path . '/'. $group->id;
            $links = array(
                $this->LinkToRemote($this->_('Details'), 'plugg-content', $this->getUrl($group_path)),
                $this->LinkToRemote($this->_('Edit'), 'plugg-content', $this->getUrl($group_path . '/edit')),
            );
            $form['groups']['#options'][$group->id] = array(
                'icon' => $this->Groups_GroupIcon($group),
                'display_name' => $this->Groups_GroupLink($group),
                'created' => sprintf('%s by %s', $this->DateTime($group->created), $this->User_IdentityLink($group->User)),
                'type' => $group->getTypeStr(),
                'member_count' => $group->member_count,
                'links' => implode(PHP_EOL, $links),
            );
        }
        
        $this->_cancelUrl = null;
        $this->_submitButtonLabel = $this->_('Delete selected');
        
        // Add page navigation to the footer if more than a page
        if ($pages->count() > 1) {
            $form['groups']['#footer'] = $this->PageNavRemote(
                'plugg-content', $pages, $page->getPageNumber(), $this->getUrl($path, array('sort' => $sort, 'order' => $order))
            );
        }
        
        return $form;
    }
    
    public function submitForm(Plugg_Form_Form $form, Sabai_Request $request, Sabai_Application_Response $response)
    {
        if (empty($form->values['groups'])) return true;
        
        $model = $this->getPluginModel();
        $groups = $model->Group->criteria()->id_in($form->values['groups'])->fetch();
        foreach ($groups as $group) {
            $group->markRemoved();
            
            // Remove avatar files if any
            $group->unlinkAvatars();
        }
        
        if (!$model->commit()) return false;
        
        foreach ($groups as $group) {
            $this->DispatchEvent('GroupsGroupDeleteSuccess', array($group));
        }
        
        return true;
    }
}