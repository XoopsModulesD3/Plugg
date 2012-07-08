<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
plugins/User/Model/Member.php
*/
abstract class Plugg_User_Model_Base_Member extends Sabai_Model_Entity
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Member', $model);
        $this->_vars = array('member_id' => 0, 'member_created' => 0, 'member_updated' => 0, 'member_role_id' => 0, 'member_user_id' => 0);
    }

    public function __clone()
    {
        $this->_vars = array_merge($this->_vars, array('member_id' => 0, 'member_created' => 0, 'member_updated' => 0));
    }

    public function __toString()
    {
        return 'Member #' . $this->_get('id', null, null);
    }

    public function assignUser($user, $markDirty = true)
    {
        $this->_set('user_id', $user->id, $markDirty);
        return $this;
    }

    protected function _fetchUser($withData = false)
    {
        if (!isset($this->_objects['User'])) {
            $this->_objects['User'] = $this->_model->User_Identity($this->_vars['member_user_id'], $withData);
        }

        return $this->_objects['User'];
    }

    public function isOwnedBy($user)
    {
        return $this->user_id && $this->user_id == $user->id;
    }

    public function assignRole(Plugg_User_Model_Role $entity)
    {
        $this->_assignEntity($entity, 'role_id');
        return $this;
    }

    public function unassignRole()
    {
        $this->_unassignEntity('Role', 'role_id');
        return $this;
    }

    protected function _fetchRole()
    {
        return $this->_fetchEntity('Role', 'role_id');
    }

    protected function _get($name, $sort, $order, $limit = 0, $offset = 0)
    {
        switch ($name) {
        case 'id':
            return $this->_vars['member_id'];
        case 'created':
            return $this->_vars['member_created'];
        case 'updated':
            return $this->_vars['member_updated'];
        case 'role_id':
            return $this->_vars['member_role_id'];
        case 'user_id':
            return $this->_vars['member_user_id'];
        case 'Role':
            return $this->_fetchRole();
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
            $this->_setVar('member_id', $value, $markDirty);
            break;
        case 'role_id':
            $this->_setVar('member_role_id', $value, $markDirty);
            break;
        case 'user_id':
            $this->_setVar('member_user_id', $value, $markDirty);
            break;
        case 'Role':
            $entity = is_array($value) ? $value[0] : $value;
            $this->assignRole($entity);
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

abstract class Plugg_User_Model_Base_MemberRepository extends Sabai_Model_EntityRepository
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Member', $model);
    }

    public function fetchByUser($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('member_user_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByUser($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('User', $id, $perpage, $sort, $order);
    }

    public function countByUser($id)
    {
        return $this->_countByForeign('member_user_id', $id);
    }

    public function fetchByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('member_user_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('User', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByUserAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('member_user_id', $id, $criteria);
    }

    public function fetchByRole($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('member_role_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByRole($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('Role', $id, $perpage, $sort, $order);
    }

    public function countByRole($id)
    {
        return $this->_countByForeign('member_role_id', $id);
    }

    public function fetchByRoleAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('member_role_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByRoleAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('Role', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByRoleAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('member_role_id', $id, $criteria);
    }

    protected function _getCollectionByRowset(Sabai_DB_Rowset $rs)
    {
        return new Plugg_User_Model_Base_MembersByRowset($rs, $this->_model->create('Member'), $this->_model);
    }

    public function createCollection(array $entities = array())
    {
        return new Plugg_User_Model_Base_Members($this->_model, $entities);
    }
}

class Plugg_User_Model_Base_MembersByRowset extends Sabai_Model_EntityCollection_Rowset
{
    public function __construct(Sabai_DB_Rowset $rs, Plugg_User_Model_Member $emptyEntity, Sabai_Model $model)
    {
        parent::__construct('Members', $rs, $emptyEntity, $model);
    }

    protected function _loadRow(Sabai_Model_Entity $entity, array $row)
    {
        $entity->initVars($row);
    }
}

class Plugg_User_Model_Base_Members extends Sabai_Model_EntityCollection_Array
{
    public function __construct(Sabai_Model $model, array $entities = array())
    {
        parent::__construct($model, 'Members', $entities);
    }
}