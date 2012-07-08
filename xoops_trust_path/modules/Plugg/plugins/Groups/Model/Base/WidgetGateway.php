<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
pluginsy/Groups/Model/WidgetGateway.php
*/
abstract class Plugg_Groups_Model_Base_WidgetGateway extends Sabai_Model_Gateway
{
    public function getName()
    {
        return 'widget';
    }

    public function getFields()
    {
        return array('widget_id' => Sabai_Model::KEY_TYPE_INT, 'widget_created' => Sabai_Model::KEY_TYPE_INT, 'widget_updated' => Sabai_Model::KEY_TYPE_INT, 'widget_name' => Sabai_Model::KEY_TYPE_VARCHAR, 'widget_plugin' => Sabai_Model::KEY_TYPE_VARCHAR, 'widget_type' => Sabai_Model::KEY_TYPE_INT);
    }

    protected function _getSelectByIdQuery($id, $fields)
    {
        return sprintf(
            'SELECT %s FROM %swidget WHERE widget_id = %d',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $id
        );
    }

    protected function _getSelectByIdsQuery($ids, $fields)
    {
        return sprintf(
            'SELECT %s FROM %swidget WHERE widget_id IN (%s)',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            implode(',', array_map('intval', $ids))
        );
    }

    protected function _getSelectByCriteriaQuery($criteriaStr, $fields)
    {
        return sprintf(
            'SELECT %1$s FROM %2$swidget WHERE %3$s',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $criteriaStr
        );
    }

    protected function _getInsertQuery($values)
    {
        $values['widget_created'] = time();
        $values['widget_updated'] = 0;
        return sprintf("INSERT INTO %swidget(widget_created, widget_updated, widget_name, widget_plugin, widget_type) VALUES(%d, %d, %s, %s, %d)", $this->_db->getResourcePrefix(), $values['widget_created'], $values['widget_updated'], $this->_db->escapeString($values['widget_name']), $this->_db->escapeString($values['widget_plugin']), $values['widget_type']);
    }

    protected function _getUpdateQuery($id, $values)
    {
        $last_update = $values['widget_updated'];
        $values['widget_updated'] = time();
        return sprintf("UPDATE %swidget SET widget_updated = %d, widget_name = %s, widget_plugin = %s, widget_type = %d WHERE widget_id = %d AND widget_updated = %d", $this->_db->getResourcePrefix(), $values['widget_updated'], $this->_db->escapeString($values['widget_name']), $this->_db->escapeString($values['widget_plugin']), $values['widget_type'], $id, $last_update);
    }

    protected function _getDeleteQuery($id)
    {
        return sprintf('DELETE FROM %1$swidget WHERE widget_id = %2$d', $this->_db->getResourcePrefix(), $id);
    }

    protected function _getUpdateByCriteriaQuery($criteriaStr, $sets)
    {
        $sets['widget_updated'] = 'widget_updated=' . time();
        return sprintf('UPDATE %swidget SET %s WHERE %s', $this->_db->getResourcePrefix(), implode(',', $sets), $criteriaStr);
    }

    protected function _getDeleteByCriteriaQuery($criteriaStr)
    {
        return sprintf('DELETE FROM %1$swidget WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _getCountByCriteriaQuery($criteriaStr)
    {
        return sprintf('SELECT COUNT(*) FROM %1$swidget WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _beforeDeleteTrigger1($id, $old)
    {
        return $this->_db->exec(sprintf('DELETE FROM %1$sactivewidget WHERE %1$sactivewidget.activewidget_widget_id = %2$d', $this->_db->getResourcePrefix(), $id), false);
    }

    protected function _beforeDeleteTrigger($id, $old)
    {
        if (!$this->_beforeDeleteTrigger1($id, $old)) return false;
        return true;
    }
}