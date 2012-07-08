<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
pluginsy/User/Model/AutologinGateway.php
*/
abstract class Plugg_User_Model_Base_AutologinGateway extends Sabai_Model_Gateway
{
    public function getName()
    {
        return 'autologin';
    }

    public function getFields()
    {
        return array('autologin_id' => Sabai_Model::KEY_TYPE_INT, 'autologin_created' => Sabai_Model::KEY_TYPE_INT, 'autologin_updated' => Sabai_Model::KEY_TYPE_INT, 'autologin_salt' => Sabai_Model::KEY_TYPE_VARCHAR, 'autologin_expires' => Sabai_Model::KEY_TYPE_INT, 'autologin_last_ip' => Sabai_Model::KEY_TYPE_VARCHAR, 'autologin_last_ua' => Sabai_Model::KEY_TYPE_VARCHAR, 'autologin_user_id' => Sabai_Model::KEY_TYPE_INT);
    }

    protected function _getSelectByIdQuery($id, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sautologin WHERE autologin_id = %d',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $id
        );
    }

    protected function _getSelectByIdsQuery($ids, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sautologin WHERE autologin_id IN (%s)',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            implode(',', array_map('intval', $ids))
        );
    }

    protected function _getSelectByCriteriaQuery($criteriaStr, $fields)
    {
        return sprintf(
            'SELECT %1$s FROM %2$sautologin WHERE %3$s',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $criteriaStr
        );
    }

    protected function _getInsertQuery($values)
    {
        $values['autologin_created'] = time();
        $values['autologin_updated'] = 0;
        return sprintf("INSERT INTO %sautologin(autologin_created, autologin_updated, autologin_salt, autologin_expires, autologin_last_ip, autologin_last_ua, autologin_user_id) VALUES(%d, %d, %s, %d, %s, %s, %d)", $this->_db->getResourcePrefix(), $values['autologin_created'], $values['autologin_updated'], $this->_db->escapeString($values['autologin_salt']), $values['autologin_expires'], $this->_db->escapeString($values['autologin_last_ip']), $this->_db->escapeString($values['autologin_last_ua']), $values['autologin_user_id']);
    }

    protected function _getUpdateQuery($id, $values)
    {
        $last_update = $values['autologin_updated'];
        $values['autologin_updated'] = time();
        return sprintf("UPDATE %sautologin SET autologin_updated = %d, autologin_salt = %s, autologin_expires = %d, autologin_last_ip = %s, autologin_last_ua = %s, autologin_user_id = %d WHERE autologin_id = %d AND autologin_updated = %d", $this->_db->getResourcePrefix(), $values['autologin_updated'], $this->_db->escapeString($values['autologin_salt']), $values['autologin_expires'], $this->_db->escapeString($values['autologin_last_ip']), $this->_db->escapeString($values['autologin_last_ua']), $values['autologin_user_id'], $id, $last_update);
    }

    protected function _getDeleteQuery($id)
    {
        return sprintf('DELETE FROM %1$sautologin WHERE autologin_id = %2$d', $this->_db->getResourcePrefix(), $id);
    }

    protected function _getUpdateByCriteriaQuery($criteriaStr, $sets)
    {
        $sets['autologin_updated'] = 'autologin_updated=' . time();
        return sprintf('UPDATE %sautologin SET %s WHERE %s', $this->_db->getResourcePrefix(), implode(',', $sets), $criteriaStr);
    }

    protected function _getDeleteByCriteriaQuery($criteriaStr)
    {
        return sprintf('DELETE FROM %1$sautologin WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _getCountByCriteriaQuery($criteriaStr)
    {
        return sprintf('SELECT COUNT(*) FROM %1$sautologin WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }
}