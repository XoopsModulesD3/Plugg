<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
plugins/Forum/Model/View.php
*/
abstract class Plugg_Forum_Model_Base_View extends Sabai_Model_Entity
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('View', $model);
        $this->_vars = array('view_id' => 0, 'view_created' => 0, 'view_updated' => 0, 'view_last_viewed' => 0, 'view_topic_id' => 0, 'view_user_id' => 0);
    }

    public function __clone()
    {
        $this->_vars = array_merge($this->_vars, array('view_id' => 0, 'view_created' => 0, 'view_updated' => 0));
    }

    public function __toString()
    {
        return 'View #' . $this->_get('id', null, null);
    }

    public function assignUser($user, $markDirty = true)
    {
        $this->_set('user_id', $user->id, $markDirty);
        return $this;
    }

    protected function _fetchUser($withData = false)
    {
        if (!isset($this->_objects['User'])) {
            $this->_objects['User'] = $this->_model->User_Identity($this->_vars['view_user_id'], $withData);
        }

        return $this->_objects['User'];
    }

    public function isOwnedBy($user)
    {
        return $this->user_id && $this->user_id == $user->id;
    }

    public function assignTopic(Plugg_Forum_Model_Topic $entity)
    {
        $this->_assignEntity($entity, 'topic_id');
        return $this;
    }

    public function unassignTopic()
    {
        $this->_unassignEntity('Topic', 'topic_id');
        return $this;
    }

    protected function _fetchTopic()
    {
        return $this->_fetchEntity('Topic', 'topic_id');
    }

    protected function _get($name, $sort, $order, $limit = 0, $offset = 0)
    {
        switch ($name) {
        case 'id':
            return $this->_vars['view_id'];
        case 'created':
            return $this->_vars['view_created'];
        case 'updated':
            return $this->_vars['view_updated'];
        case 'last_viewed':
            return $this->_vars['view_last_viewed'];
        case 'topic_id':
            return $this->_vars['view_topic_id'];
        case 'user_id':
            return $this->_vars['view_user_id'];
        case 'Topic':
            return $this->_fetchTopic();
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
            $this->_setVar('view_id', $value, $markDirty);
            break;
        case 'last_viewed':
            $this->_setVar('view_last_viewed', $value, $markDirty);
            break;
        case 'topic_id':
            $this->_setVar('view_topic_id', $value, $markDirty);
            break;
        case 'user_id':
            $this->_setVar('view_user_id', $value, $markDirty);
            break;
        case 'Topic':
            $entity = is_array($value) ? $value[0] : $value;
            $this->assignTopic($entity);
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

abstract class Plugg_Forum_Model_Base_ViewRepository extends Sabai_Model_EntityRepository
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('View', $model);
    }

    public function fetchByUser($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('view_user_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByUser($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('User', $id, $perpage, $sort, $order);
    }

    public function countByUser($id)
    {
        return $this->_countByForeign('view_user_id', $id);
    }

    public function fetchByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('view_user_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('User', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByUserAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('view_user_id', $id, $criteria);
    }

    public function fetchByTopic($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('view_topic_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByTopic($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('Topic', $id, $perpage, $sort, $order);
    }

    public function countByTopic($id)
    {
        return $this->_countByForeign('view_topic_id', $id);
    }

    public function fetchByTopicAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('view_topic_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByTopicAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('Topic', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByTopicAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('view_topic_id', $id, $criteria);
    }

    protected function _getCollectionByRowset(Sabai_DB_Rowset $rs)
    {
        return new Plugg_Forum_Model_Base_ViewsByRowset($rs, $this->_model->create('View'), $this->_model);
    }

    public function createCollection(array $entities = array())
    {
        return new Plugg_Forum_Model_Base_Views($this->_model, $entities);
    }
}

class Plugg_Forum_Model_Base_ViewsByRowset extends Sabai_Model_EntityCollection_Rowset
{
    public function __construct(Sabai_DB_Rowset $rs, Plugg_Forum_Model_View $emptyEntity, Sabai_Model $model)
    {
        parent::__construct('Views', $rs, $emptyEntity, $model);
    }

    protected function _loadRow(Sabai_Model_Entity $entity, array $row)
    {
        $entity->initVars($row);
    }
}

class Plugg_Forum_Model_Base_Views extends Sabai_Model_EntityCollection_Array
{
    public function __construct(Sabai_Model $model, array $entities = array())
    {
        parent::__construct($model, 'Views', $entities);
    }
}