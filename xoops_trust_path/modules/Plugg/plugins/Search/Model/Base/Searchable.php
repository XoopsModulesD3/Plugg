<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
plugins/Search/Model/Searchable.php
*/
abstract class Plugg_Search_Model_Base_Searchable extends Sabai_Model_Entity
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Searchable', $model);
        $this->_vars = array('searchable_id' => 0, 'searchable_created' => 0, 'searchable_updated' => 0, 'searchable_name' => null, 'searchable_plugin' => null, 'searchable_private' => 0);
    }

    public function __clone()
    {
        $this->_vars = array_merge($this->_vars, array('searchable_id' => 0, 'searchable_created' => 0, 'searchable_updated' => 0));
    }

    public function __toString()
    {
        return 'Searchable #' . $this->_get('id', null, null);
    }

    public function linkEngine(Plugg_Search_Model_Engine $entity)
    {
        return $this->linkEngineById($entity->id);
    }

    public function linkEngineById($id)
    {
        return $this->_linkEntityById('Searchable2engine', 'engine_id', $id);
    }

    public function unlinkEngine(Plugg_Search_Model_Engine $entity)
    {
        return $this->unlinkEngineById($entity->id);
    }

    public function unlinkEngineById($id)
    {
        return $this->_unlinkEntityById('Searchable2engine', 'searchable2engine_searchable_id', 'searchable2engine_engine_id', $id);
    }

    public function unlinkEngines()
    {
        return $this->_unlinkEntities('Searchable2engine');
    }

    protected function _fetchEngines($limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchEntities('Engine', $limit, $offset, $sort, $order);
    }

    public function paginateEngines($perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateEntities('Engine', $perpage, $sort, $order);
    }

    public function countEngines()
    {
        return $this->_countEntities('Engine');
    }

    protected function _get($name, $sort, $order, $limit = 0, $offset = 0)
    {
        switch ($name) {
        case 'id':
            return $this->_vars['searchable_id'];
        case 'created':
            return $this->_vars['searchable_created'];
        case 'updated':
            return $this->_vars['searchable_updated'];
        case 'name':
            return $this->_vars['searchable_name'];
        case 'plugin':
            return $this->_vars['searchable_plugin'];
        case 'private':
            return $this->_vars['searchable_private'];
        case 'Engines':
            return $this->_fetchEngines($limit, $offset, $sort, $order);
default:
return isset($this->_objects[$name]) ? $this->_objects[$name] : null;
        }
    }

    protected function _set($name, $value, $markDirty)
    {
        switch ($name) {
        case 'id':
            $this->_setVar('searchable_id', $value, $markDirty);
            break;
        case 'name':
            $this->_setVar('searchable_name', $value, $markDirty);
            break;
        case 'plugin':
            $this->_setVar('searchable_plugin', $value, $markDirty);
            break;
        case 'private':
            $this->_setVar('searchable_private', $value, $markDirty);
            break;
        case 'Engines':
            $this->unlinkEngines();
            foreach (array_keys($value) as $i) {
                if (is_object($value[$i])) {
                    $this->linkEngine($value[$i]);
                } else {
                    $this->linkEngineById($value[$i]);
                }
            }
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

abstract class Plugg_Search_Model_Base_SearchableRepository extends Sabai_Model_EntityRepository
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Searchable', $model);
    }

    public function fetchByEngine($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByAssoc('searchable', 'Searchable2engine', 'searchable2engine_engine_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByEngine($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('Engine', $id, $perpage, $sort, $order);
    }

    public function countByEngine($id)
    {
        return $this->_countByAssoc('searchable_id', 'Searchable2engine', 'searchable2engine_engine_id', $id);
    }

    public function fetchByEngineAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByAssocAndCriteria('searchable', 'Searchable2engine', 'searchable2engine_engine_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function countByEngineAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByAssocAndCriteria('searchable_id', 'Searchable2engine', 'searchable2engine_engine_id', $id, $criteria);
    }

    public function paginateByEngineAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('Engine', $id, $criteria, $perpage, $sort, $order);
    }

    protected function _getCollectionByRowset(Sabai_DB_Rowset $rs)
    {
        return new Plugg_Search_Model_Base_SearchablesByRowset($rs, $this->_model->create('Searchable'), $this->_model);
    }

    public function createCollection(array $entities = array())
    {
        return new Plugg_Search_Model_Base_Searchables($this->_model, $entities);
    }
}

class Plugg_Search_Model_Base_SearchablesByRowset extends Sabai_Model_EntityCollection_Rowset
{
    public function __construct(Sabai_DB_Rowset $rs, Plugg_Search_Model_Searchable $emptyEntity, Sabai_Model $model)
    {
        parent::__construct('Searchables', $rs, $emptyEntity, $model);
    }

    protected function _loadRow(Sabai_Model_Entity $entity, array $row)
    {
        $entity->initVars($row);
    }
}

class Plugg_Search_Model_Base_Searchables extends Sabai_Model_EntityCollection_Array
{
    public function __construct(Sabai_Model $model, array $entities = array())
    {
        parent::__construct($model, 'Searchables', $entities);
    }
}