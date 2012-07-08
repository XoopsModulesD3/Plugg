<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
pluginsy/User/Model/RoleGateway.php
*/
abstract class Plugg_User_Model_Base_RoleGateway extends Sabai_Model_Gateway
{
    public function getName()
    {
        return 'role';
    }

    public function getFields()
    {
        return array('role_id' => Sabai_Model::KEY_TYPE_INT, 'role_created' => Sabai_Model::KEY_TYPE_INT, 'role_updated' => Sabai_Model::KEY_TYPE_INT, 'role_name' => Sabai_Model::KEY_TYPE_VARCHAR, 'role_display_name' => Sabai_Model::KEY_TYPE_VARCHAR, 'role_permissions' => Sabai_Model::KEY_TYPE_TEXT, 'role_system' => Sabai_Model::KEY_TYPE_INT, 'role_member_count' => Sabai_Model::KEY_TYPE_INT, 'role_member_last' => Sabai_Model::KEY_TYPE_INT, 'role_member_lasttime' => Sabai_Model::KEY_TYPE_INT);
    }

    protected function _getSelectByIdQuery($id, $fields)
    {
        return sprintf(
            'SELECT %s FROM %srole WHERE role_id = %d',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $id
        );
    }

    protected function _getSelectByIdsQuery($ids, $fields)
    {
        return sprintf(
            'SELECT %s FROM %srole WHERE role_id IN (%s)',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            implode(',', array_map('intval', $ids))
        );
    }

    protected function _getSelectByCriteriaQuery($criteriaStr, $fields)
    {
        return sprintf(
            'SELECT %1$s FROM %2$srole WHERE %3$s',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $criteriaStr
        );
    }

    protected function _getInsertQuery($values)
    {
        $values['role_created'] = time();
        $values['role_updated'] = 0;
        $values['role_member_lasttime'] = $values['role_created'];
        return sprintf("INSERT INTO %srole(role_created, role_updated, role_name, role_display_name, role_permissions, role_system, role_member_count, role_member_last, role_member_lasttime) VALUES(%d, %d, %s, %s, %s, %d, %d, %d, %d)", $this->_db->getResourcePrefix(), $values['role_created'], $values['role_updated'], $this->_db->escapeString($values['role_name']), $this->_db->escapeString($values['role_display_name']), $this->_db->escapeString($values['role_permissions']), $values['role_system'], $values['role_member_count'], $values['role_member_last'], $values['role_member_lasttime']);
    }

    protected function _getUpdateQuery($id, $values)
    {
        $last_update = $values['role_updated'];
        $values['role_updated'] = time();
        return sprintf("UPDATE %srole SET role_updated = %d, role_name = %s, role_display_name = %s, role_permissions = %s, role_system = %d WHERE role_id = %d AND role_updated = %d", $this->_db->getResourcePrefix(), $values['role_updated'], $this->_db->escapeString($values['role_name']), $this->_db->escapeString($values['role_display_name']), $this->_db->escapeString($values['role_permissions']), $values['role_system'], $id, $last_update);
    }

    protected function _getDeleteQuery($id)
    {
        return sprintf('DELETE FROM %1$srole WHERE role_id = %2$d', $this->_db->getResourcePrefix(), $id);
    }

    protected function _getUpdateByCriteriaQuery($criteriaStr, $sets)
    {
        $sets['role_updated'] = 'role_updated=' . time();
        return sprintf('UPDATE %srole SET %s WHERE %s', $this->_db->getResourcePrefix(), implode(',', $sets), $criteriaStr);
    }

    protected function _getDeleteByCriteriaQuery($criteriaStr)
    {
        return sprintf('DELETE FROM %1$srole WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _getCountByCriteriaQuery($criteriaStr)
    {
        return sprintf('SELECT COUNT(*) FROM %1$srole WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _beforeDeleteTrigger1($id, $old)
    {
        return $this->_db->exec(sprintf('DELETE FROM %1$smember WHERE %1$smember.member_role_id = %2$d', $this->_db->getResourcePrefix(), $id), false);
    }

    protected function _beforeDeleteTrigger($id, $old)
    {
        if (!$this->_beforeDeleteTrigger1($id, $old)) return false;
        return true;
    }
}