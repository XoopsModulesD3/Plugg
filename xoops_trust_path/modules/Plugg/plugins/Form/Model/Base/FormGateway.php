<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
pluginsy/Form/Model/FormGateway.php
*/
abstract class Plugg_Form_Model_Base_FormGateway extends Sabai_Model_Gateway
{
    public function getName()
    {
        return 'form';
    }

    public function getFields()
    {
        return array('form_id' => Sabai_Model::KEY_TYPE_INT, 'form_created' => Sabai_Model::KEY_TYPE_INT, 'form_updated' => Sabai_Model::KEY_TYPE_INT, 'form_title' => Sabai_Model::KEY_TYPE_VARCHAR, 'form_header' => Sabai_Model::KEY_TYPE_TEXT, 'form_header_formatted' => Sabai_Model::KEY_TYPE_TEXT, 'form_header_format' => Sabai_Model::KEY_TYPE_INT, 'form_hidden' => Sabai_Model::KEY_TYPE_INT, 'form_weight' => Sabai_Model::KEY_TYPE_INT, 'form_submit_button_label' => Sabai_Model::KEY_TYPE_VARCHAR, 'form_confirm' => Sabai_Model::KEY_TYPE_INT, 'form_confirm_button_label' => Sabai_Model::KEY_TYPE_VARCHAR, 'form_anon_view' => Sabai_Model::KEY_TYPE_INT, 'form_anon_submit' => Sabai_Model::KEY_TYPE_INT, 'form_email_settings' => Sabai_Model::KEY_TYPE_TEXT, 'form_formentry_count' => Sabai_Model::KEY_TYPE_INT, 'form_formentry_last' => Sabai_Model::KEY_TYPE_INT, 'form_formentry_lasttime' => Sabai_Model::KEY_TYPE_INT);
    }

    protected function _getSelectByIdQuery($id, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sform WHERE form_id = %d',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $id
        );
    }

    protected function _getSelectByIdsQuery($ids, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sform WHERE form_id IN (%s)',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            implode(',', array_map('intval', $ids))
        );
    }

    protected function _getSelectByCriteriaQuery($criteriaStr, $fields)
    {
        return sprintf(
            'SELECT %1$s FROM %2$sform WHERE %3$s',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $criteriaStr
        );
    }

    protected function _getInsertQuery($values)
    {
        $values['form_created'] = time();
        $values['form_updated'] = 0;
        $values['form_formentry_lasttime'] = $values['form_created'];
        return sprintf("INSERT INTO %sform(form_created, form_updated, form_title, form_header, form_header_formatted, form_header_format, form_hidden, form_weight, form_submit_button_label, form_confirm, form_confirm_button_label, form_anon_view, form_anon_submit, form_email_settings, form_formentry_count, form_formentry_last, form_formentry_lasttime) VALUES(%d, %d, %s, %s, %s, %d, %d, %d, %s, %d, %s, %d, %d, %s, %d, %d, %d)", $this->_db->getResourcePrefix(), $values['form_created'], $values['form_updated'], $this->_db->escapeString($values['form_title']), $this->_db->escapeString($values['form_header']), $this->_db->escapeString($values['form_header_formatted']), $values['form_header_format'], $values['form_hidden'], $values['form_weight'], $this->_db->escapeString($values['form_submit_button_label']), $values['form_confirm'], $this->_db->escapeString($values['form_confirm_button_label']), $values['form_anon_view'], $values['form_anon_submit'], $this->_db->escapeString($values['form_email_settings']), $values['form_formentry_count'], $values['form_formentry_last'], $values['form_formentry_lasttime']);
    }

    protected function _getUpdateQuery($id, $values)
    {
        $last_update = $values['form_updated'];
        $values['form_updated'] = time();
        return sprintf("UPDATE %sform SET form_updated = %d, form_title = %s, form_header = %s, form_header_formatted = %s, form_header_format = %d, form_hidden = %d, form_weight = %d, form_submit_button_label = %s, form_confirm = %d, form_confirm_button_label = %s, form_anon_view = %d, form_anon_submit = %d, form_email_settings = %s WHERE form_id = %d AND form_updated = %d", $this->_db->getResourcePrefix(), $values['form_updated'], $this->_db->escapeString($values['form_title']), $this->_db->escapeString($values['form_header']), $this->_db->escapeString($values['form_header_formatted']), $values['form_header_format'], $values['form_hidden'], $values['form_weight'], $this->_db->escapeString($values['form_submit_button_label']), $values['form_confirm'], $this->_db->escapeString($values['form_confirm_button_label']), $values['form_anon_view'], $values['form_anon_submit'], $this->_db->escapeString($values['form_email_settings']), $id, $last_update);
    }

    protected function _getDeleteQuery($id)
    {
        return sprintf('DELETE FROM %1$sform WHERE form_id = %2$d', $this->_db->getResourcePrefix(), $id);
    }

    protected function _getUpdateByCriteriaQuery($criteriaStr, $sets)
    {
        $sets['form_updated'] = 'form_updated=' . time();
        return sprintf('UPDATE %sform SET %s WHERE %s', $this->_db->getResourcePrefix(), implode(',', $sets), $criteriaStr);
    }

    protected function _getDeleteByCriteriaQuery($criteriaStr)
    {
        return sprintf('DELETE FROM %1$sform WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _getCountByCriteriaQuery($criteriaStr)
    {
        return sprintf('SELECT COUNT(*) FROM %1$sform WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _beforeDeleteTrigger1($id, $old)
    {
        return $this->_db->exec(sprintf('DELETE FROM %1$sformfield WHERE %1$sformfield.formfield_form_id = %2$d', $this->_db->getResourcePrefix(), $id), false);
    }

    protected function _beforeDeleteTrigger2($id, $old)
    {
        return $this->_db->exec(sprintf('DELETE FROM %1$sformentry WHERE %1$sformentry.formentry_form_id = %2$d', $this->_db->getResourcePrefix(), $id), false);
    }

    protected function _beforeDeleteTrigger($id, $old)
    {
        if (!$this->_beforeDeleteTrigger1($id, $old)) return false;
        if (!$this->_beforeDeleteTrigger2($id, $old)) return false;
        return true;
    }
}