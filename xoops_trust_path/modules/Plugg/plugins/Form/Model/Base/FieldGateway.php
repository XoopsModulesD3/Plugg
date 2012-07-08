<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
pluginsy/Form/Model/FieldGateway.php
*/
abstract class Plugg_Form_Model_Base_FieldGateway extends Sabai_Model_Gateway
{
    public function getName()
    {
        return 'field';
    }

    public function getFields()
    {
        return array('field_id' => Sabai_Model::KEY_TYPE_INT, 'field_created' => Sabai_Model::KEY_TYPE_INT, 'field_updated' => Sabai_Model::KEY_TYPE_INT, 'field_type' => Sabai_Model::KEY_TYPE_VARCHAR, 'field_plugin' => Sabai_Model::KEY_TYPE_VARCHAR, 'field_system' => Sabai_Model::KEY_TYPE_INT);
    }

    protected function _getSelectByIdQuery($id, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sfield WHERE field_id = %d',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $id
        );
    }

    protected function _getSelectByIdsQuery($ids, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sfield WHERE field_id IN (%s)',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            implode(',', array_map('intval', $ids))
        );
    }

    protected function _getSelectByCriteriaQuery($criteriaStr, $fields)
    {
        return sprintf(
            'SELECT %1$s FROM %2$sfield WHERE %3$s',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $criteriaStr
        );
    }

    protected function _getInsertQuery($values)
    {
        $values['field_created'] = time();
        $values['field_updated'] = 0;
        return sprintf("INSERT INTO %sfield(field_created, field_updated, field_type, field_plugin, field_system) VALUES(%d, %d, %s, %s, %d)", $this->_db->getResourcePrefix(), $values['field_created'], $values['field_updated'], $this->_db->escapeString($values['field_type']), $this->_db->escapeString($values['field_plugin']), $values['field_system']);
    }

    protected function _getUpdateQuery($id, $values)
    {
        $last_update = $values['field_updated'];
        $values['field_updated'] = time();
        return sprintf("UPDATE %sfield SET field_updated = %d, field_type = %s, field_plugin = %s, field_system = %d WHERE field_id = %d AND field_updated = %d", $this->_db->getResourcePrefix(), $values['field_updated'], $this->_db->escapeString($values['field_type']), $this->_db->escapeString($values['field_plugin']), $values['field_system'], $id, $last_update);
    }

    protected function _getDeleteQuery($id)
    {
        return sprintf('DELETE FROM %1$sfield WHERE field_id = %2$d', $this->_db->getResourcePrefix(), $id);
    }

    protected function _getUpdateByCriteriaQuery($criteriaStr, $sets)
    {
        $sets['field_updated'] = 'field_updated=' . time();
        return sprintf('UPDATE %sfield SET %s WHERE %s', $this->_db->getResourcePrefix(), implode(',', $sets), $criteriaStr);
    }

    protected function _getDeleteByCriteriaQuery($criteriaStr)
    {
        return sprintf('DELETE FROM %1$sfield WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _getCountByCriteriaQuery($criteriaStr)
    {
        return sprintf('SELECT COUNT(*) FROM %1$sfield WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _beforeDeleteTrigger1($id, $old)
    {
        return $this->_db->exec(sprintf('DELETE FROM %1$sformfield WHERE %1$sformfield.formfield_field_id = %2$d', $this->_db->getResourcePrefix(), $id), false);
    }

    protected function _beforeDeleteTrigger($id, $old)
    {
        if (!$this->_beforeDeleteTrigger1($id, $old)) return false;
        return true;
    }
}