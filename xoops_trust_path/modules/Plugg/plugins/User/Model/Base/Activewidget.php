<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
plugins/User/Model/Activewidget.php
*/
abstract class Plugg_User_Model_Base_Activewidget extends Sabai_Model_Entity
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Activewidget', $model);
        $this->_vars = array('activewidget_id' => 0, 'activewidget_created' => 0, 'activewidget_updated' => 0, 'activewidget_title' => null, 'activewidget_order' => 0, 'activewidget_private' => 0, 'activewidget_position' => 0, 'activewidget_settings' => null, 'activewidget_cache' => null, 'activewidget_cache_time' => 0, 'activewidget_cache_lifetime' => 86400, 'activewidget_widget_id' => 0, 'activewidget_user_id' => 0);
    }

    public function __clone()
    {
        $this->_vars = array_merge($this->_vars, array('activewidget_id' => 0, 'activewidget_created' => 0, 'activewidget_updated' => 0));
    }

    public function __toString()
    {
        return 'Activewidget #' . $this->_get('id', null, null);
    }

    public function assignUser($user, $markDirty = true)
    {
        $this->_set('user_id', $user->id, $markDirty);
        return $this;
    }

    protected function _fetchUser($withData = false)
    {
        if (!isset($this->_objects['User'])) {
            $this->_objects['User'] = $this->_model->User_Identity($this->_vars['activewidget_user_id'], $withData);
        }

        return $this->_objects['User'];
    }

    public function isOwnedBy($user)
    {
        return $this->user_id && $this->user_id == $user->id;
    }

    public function assignWidget(Plugg_User_Model_Widget $entity)
    {
        $this->_assignEntity($entity, 'widget_id');
        return $this;
    }

    public function unassignWidget()
    {
        $this->_unassignEntity('Widget', 'widget_id');
        return $this;
    }

    protected function _fetchWidget()
    {
        return $this->_fetchEntity('Widget', 'widget_id');
    }

    protected function _get($name, $sort, $order, $limit = 0, $offset = 0)
    {
        switch ($name) {
        case 'id':
            return $this->_vars['activewidget_id'];
        case 'created':
            return $this->_vars['activewidget_created'];
        case 'updated':
            return $this->_vars['activewidget_updated'];
        case 'title':
            return $this->_vars['activewidget_title'];
        case 'order':
            return $this->_vars['activewidget_order'];
        case 'private':
            return $this->_vars['activewidget_private'];
        case 'position':
            return $this->_vars['activewidget_position'];
        case 'settings':
            return $this->_vars['activewidget_settings'];
        case 'cache':
            return $this->_vars['activewidget_cache'];
        case 'cache_time':
            return $this->_vars['activewidget_cache_time'];
        case 'cache_lifetime':
            return $this->_vars['activewidget_cache_lifetime'];
        case 'widget_id':
            return $this->_vars['activewidget_widget_id'];
        case 'user_id':
            return $this->_vars['activewidget_user_id'];
        case 'Widget':
            return $this->_fetchWidget();
        case 'User':
            return $this->_fetchUser();
        case 'UserWithData':
            return $this->_fetchUser(true);
default:
return isset($this->_objects[$name]) ? $this->_objects[$name] : null;
        }
    }

    protected function _set($name, $value, $markDirty)
    {
        switch ($name) {
        case 'id':
            $this->_setVar('activewidget_id', $value, $markDirty);
            break;
        case 'title':
            $this->_setVar('activewidget_title', $value, $markDirty);
            break;
        case 'order':
            $this->_setVar('activewidget_order', $value, $markDirty);
            break;
        case 'private':
            $this->_setVar('activewidget_private', $value, $markDirty);
            break;
        case 'position':
            $this->_setVar('activewidget_position', $value, $markDirty);
            break;
        case 'settings':
            $this->_setVar('activewidget_settings', $value, $markDirty);
            break;
        case 'cache':
            $this->_setVar('activewidget_cache', $value, $markDirty);
            break;
        case 'cache_time':
            $this->_setVar('activewidget_cache_time', $value, $markDirty);
            break;
        case 'cache_lifetime':
            $this->_setVar('activewidget_cache_lifetime', $value, $markDirty);
            break;
        case 'widget_id':
            $this->_setVar('activewidget_widget_id', $value, $markDirty);
            break;
        case 'user_id':
            $this->_setVar('activewidget_user_id', $value, $markDirty);
            break;
        case 'Widget':
            $entity = is_array($value) ? $value[0] : $value;
            $this->assignWidget($entity);
            break;
        }
    }

    protected function _initVar($name, $value)
    {
        switch ($name) {
        default:
            $this->_vars[$name] = $value;
            break;
        }
    }
}

abstract class Plugg_User_Model_Base_ActivewidgetRepository extends Sabai_Model_EntityRepository
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Activewidget', $model);
    }

    public function fetchByUser($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('activewidget_user_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByUser($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('User', $id, $perpage, $sort, $order);
    }

    public function countByUser($id)
    {
        return $this->_countByForeign('activewidget_user_id', $id);
    }

    public function fetchByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('activewidget_user_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('User', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByUserAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('activewidget_user_id', $id, $criteria);
    }

    public function fetchByWidget($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('activewidget_widget_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByWidget($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('Widget', $id, $perpage, $sort, $order);
    }

    public function countByWidget($id)
    {
        return $this->_countByForeign('activewidget_widget_id', $id);
    }

    public function fetchByWidgetAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('activewidget_widget_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByWidgetAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('Widget', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByWidgetAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('activewidget_widget_id', $id, $criteria);
    }

    protected function _getCollectionByRowset(Sabai_DB_Rowset $rs)
    {
        return new Plugg_User_Model_Base_ActivewidgetsByRowset($rs, $this->_model->create('Activewidget'), $this->_model);
    }

    public function createCollection(array $entities = array())
    {
        return new Plugg_User_Model_Base_Activewidgets($this->_model, $entities);
    }
}

class Plugg_User_Model_Base_ActivewidgetsByRowset extends Sabai_Model_EntityCollection_Rowset
{
    public function __construct(Sabai_DB_Rowset $rs, Plugg_User_Model_Activewidget $emptyEntity, Sabai_Model $model)
    {
        parent::__construct('Activewidgets', $rs, $emptyEntity, $model);
    }

    protected function _loadRow(Sabai_Model_Entity $entity, array $row)
    {
        $entity->initVars($row);
    }
}

class Plugg_User_Model_Base_Activewidgets extends Sabai_Model_EntityCollection_Array
{
    public function __construct(Sabai_Model $model, array $entities = array())
    {
        parent::__construct($model, 'Activewidgets', $entities);
    }
}