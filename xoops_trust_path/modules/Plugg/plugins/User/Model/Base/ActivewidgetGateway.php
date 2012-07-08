<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
pluginsy/User/Model/ActivewidgetGateway.php
*/
abstract class Plugg_User_Model_Base_ActivewidgetGateway extends Sabai_Model_Gateway
{
    public function getName()
    {
        return 'activewidget';
    }

    public function getFields()
    {
        return array('activewidget_id' => Sabai_Model::KEY_TYPE_INT, 'activewidget_created' => Sabai_Model::KEY_TYPE_INT, 'activewidget_updated' => Sabai_Model::KEY_TYPE_INT, 'activewidget_title' => Sabai_Model::KEY_TYPE_VARCHAR, 'activewidget_order' => Sabai_Model::KEY_TYPE_INT, 'activewidget_private' => Sabai_Model::KEY_TYPE_INT, 'activewidget_position' => Sabai_Model::KEY_TYPE_INT, 'activewidget_settings' => Sabai_Model::KEY_TYPE_TEXT, 'activewidget_cache' => Sabai_Model::KEY_TYPE_TEXT, 'activewidget_cache_time' => Sabai_Model::KEY_TYPE_INT, 'activewidget_cache_lifetime' => Sabai_Model::KEY_TYPE_INT, 'activewidget_widget_id' => Sabai_Model::KEY_TYPE_INT, 'activewidget_user_id' => Sabai_Model::KEY_TYPE_INT);
    }

    protected function _getSelectByIdQuery($id, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sactivewidget WHERE activewidget_id = %d',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $id
        );
    }

    protected function _getSelectByIdsQuery($ids, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sactivewidget WHERE activewidget_id IN (%s)',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            implode(',', array_map('intval', $ids))
        );
    }

    protected function _getSelectByCriteriaQuery($criteriaStr, $fields)
    {
        return sprintf(
            'SELECT %1$s FROM %2$sactivewidget WHERE %3$s',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $criteriaStr
        );
    }

    protected function _getInsertQuery($values)
    {
        $values['activewidget_created'] = time();
        $values['activewidget_updated'] = 0;
        return sprintf("INSERT INTO %sactivewidget(activewidget_created, activewidget_updated, activewidget_title, activewidget_order, activewidget_private, activewidget_position, activewidget_settings, activewidget_cache, activewidget_cache_time, activewidget_cache_lifetime, activewidget_widget_id, activewidget_user_id) VALUES(%d, %d, %s, %d, %d, %d, %s, %s, %d, %d, %d, %d)", $this->_db->getResourcePrefix(), $values['activewidget_created'], $values['activewidget_updated'], $this->_db->escapeString($values['activewidget_title']), $values['activewidget_order'], $values['activewidget_private'], $values['activewidget_position'], $this->_db->escapeString($values['activewidget_settings']), $this->_db->escapeString($values['activewidget_cache']), $values['activewidget_cache_time'], $values['activewidget_cache_lifetime'], $values['activewidget_widget_id'], $values['activewidget_user_id']);
    }

    protected function _getUpdateQuery($id, $values)
    {
        $last_update = $values['activewidget_updated'];
        $values['activewidget_updated'] = time();
        return sprintf("UPDATE %sactivewidget SET activewidget_updated = %d, activewidget_title = %s, activewidget_order = %d, activewidget_private = %d, activewidget_position = %d, activewidget_settings = %s, activewidget_cache = %s, activewidget_cache_time = %d, activewidget_cache_lifetime = %d, activewidget_widget_id = %d, activewidget_user_id = %d WHERE activewidget_id = %d AND activewidget_updated = %d", $this->_db->getResourcePrefix(), $values['activewidget_updated'], $this->_db->escapeString($values['activewidget_title']), $values['activewidget_order'], $values['activewidget_private'], $values['activewidget_position'], $this->_db->escapeString($values['activewidget_settings']), $this->_db->escapeString($values['activewidget_cache']), $values['activewidget_cache_time'], $values['activewidget_cache_lifetime'], $values['activewidget_widget_id'], $values['activewidget_user_id'], $id, $last_update);
    }

    protected function _getDeleteQuery($id)
    {
        return sprintf('DELETE FROM %1$sactivewidget WHERE activewidget_id = %2$d', $this->_db->getResourcePrefix(), $id);
    }

    protected function _getUpdateByCriteriaQuery($criteriaStr, $sets)
    {
        $sets['activewidget_updated'] = 'activewidget_updated=' . time();
        return sprintf('UPDATE %sactivewidget SET %s WHERE %s', $this->_db->getResourcePrefix(), implode(',', $sets), $criteriaStr);
    }

    protected function _getDeleteByCriteriaQuery($criteriaStr)
    {
        return sprintf('DELETE FROM %1$sactivewidget WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _getCountByCriteriaQuery($criteriaStr)
    {
        return sprintf('SELECT COUNT(*) FROM %1$sactivewidget WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _afterInsertTrigger1($id, $new)
    {
    }

    protected function _afterDeleteTrigger1($id, $old)
    {
    }

    protected function _afterUpdateTrigger1($id, $new, $old)
    {
    }

    protected function _afterInsertTrigger($id, $new)
    {
        $this->_afterInsertTrigger1($id, $new);
    }

    protected function _afterUpdateTrigger($id, $new, $old)
    {
        $this->_afterUpdateTrigger1($id, $new, $old);
    }

    protected function _afterDeleteTrigger($id, $old)
    {
        $this->_afterDeleteTrigger1($id, $old);
    }
}