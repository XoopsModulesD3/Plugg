<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
plugins/Forum/Model/Comment.php
*/
abstract class Plugg_Forum_Model_Base_Comment extends Sabai_Model_TreeEntity
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Comment', $model);
        $this->_vars = array('comment_id' => 0, 'comment_created' => 0, 'comment_updated' => 0, 'comment_title' => null, 'comment_body' => null, 'comment_body_html' => null, 'comment_body_filter_id' => 0, 'comment_ip' => null, 'comment_host' => null, 'comment_parent_id' => 0, 'comment_topic_id' => 0, 'comment_parent' => 0, 'comment_user_id' => 0, 'comment_star_count' => 0, 'comment_star_last' => 0, 'comment_star_lasttime' => 0, 'comment_attachment_count' => 0, 'comment_attachment_last' => 0, 'comment_attachment_lasttime' => 0);
    }

    public function __clone()
    {
        $this->_vars = array_merge($this->_vars, array('comment_id' => 0, 'comment_created' => 0, 'comment_updated' => 0, 'comment_star_count' => 0, 'comment_star_last' => 0, 'comment_star_lasttime' => 0, 'comment_attachment_count' => 0, 'comment_attachment_last' => 0, 'comment_attachment_lasttime' => 0));
    }

    public function __toString()
    {
        return $this->_get('title', null, null);
    }

    public function assignUser($user, $markDirty = true)
    {
        $this->_set('user_id', $user->id, $markDirty);
        return $this;
    }

    protected function _fetchUser($withData = false)
    {
        if (!isset($this->_objects['User'])) {
            $this->_objects['User'] = $this->_model->User_Identity($this->_vars['comment_user_id'], $withData);
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

    public function assignParent(Plugg_Forum_Model_Comment $entity)
    {
        $this->_assignEntity($entity, 'parent');
        return $this;
    }

    public function unassignParent()
    {
        $this->_unassignEntity('Parent', 'parent');
        return $this;
    }

    protected function _fetchParent()
    {
        return $this->_fetchEntity('Comment', 'parent');
    }

    public function addStar(Plugg_Forum_Model_Star $entity)
    {
        $this->_addEntity($entity);
        return $this;
    }

    public function removeStar(Plugg_Forum_Model_Star $entity)
    {
        return $this->removeStarById($entity->id);
    }

    public function removeStarById($id)
    {
        return $this->_removeEntityById('star_id', 'Star', $id);
    }

    public function createStar()
    {
        return $this->_createEntity('Star');
    }

    protected function _fetchStars($limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchEntities('Star', $limit, $offset, $sort, $order);
    }

    protected function _fetchLastStar()
    {
        if (!isset($this->_objects['LastStar']) && $this->hasLastStar()) {
            $this->_objects['LastStar'] = $this->_fetchEntities('Star', 1, 0, 'star_created', 'DESC')->getFirst();
        }
        return $this->_objects['LastStar'];
    }

    public function paginateStars($perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateEntities('Star', $perpage, $sort, $order);
    }

    public function removeStars()
    {
        return $this->_removeEntities('Star');
    }

    public function countStars()
    {
        return $this->_countEntities('Star');
    }

    public function addAttachment(Plugg_Forum_Model_Attachment $entity)
    {
        $this->_addEntity($entity);
        return $this;
    }

    public function removeAttachment(Plugg_Forum_Model_Attachment $entity)
    {
        return $this->removeAttachmentById($entity->id);
    }

    public function removeAttachmentById($id)
    {
        return $this->_removeEntityById('attachment_id', 'Attachment', $id);
    }

    public function createAttachment()
    {
        return $this->_createEntity('Attachment');
    }

    protected function _fetchAttachments($limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchEntities('Attachment', $limit, $offset, $sort, $order);
    }

    protected function _fetchLastAttachment()
    {
        if (!isset($this->_objects['LastAttachment']) && $this->hasLastAttachment()) {
            $this->_objects['LastAttachment'] = $this->_fetchEntities('Attachment', 1, 0, 'attachment_created', 'DESC')->getFirst();
        }
        return $this->_objects['LastAttachment'];
    }

    public function paginateAttachments($perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateEntities('Attachment', $perpage, $sort, $order);
    }

    public function removeAttachments()
    {
        return $this->_removeEntities('Attachment');
    }

    public function countAttachments()
    {
        return $this->_countEntities('Attachment');
    }

    protected function _get($name, $sort, $order, $limit = 0, $offset = 0)
    {
        switch ($name) {
        case 'id':
            return $this->_vars['comment_id'];
        case 'created':
            return $this->_vars['comment_created'];
        case 'updated':
            return $this->_vars['comment_updated'];
        case 'title':
            return $this->_vars['comment_title'];
        case 'body':
            return $this->_vars['comment_body'];
        case 'body_html':
            return $this->_vars['comment_body_html'];
        case 'body_filter_id':
            return $this->_vars['comment_body_filter_id'];
        case 'ip':
            return $this->_vars['comment_ip'];
        case 'host':
            return $this->_vars['comment_host'];
        case 'parent_id':
            return $this->_vars['comment_parent_id'];
        case 'topic_id':
            return $this->_vars['comment_topic_id'];
        case 'parent':
            return $this->_vars['comment_parent'];
        case 'user_id':
            return $this->_vars['comment_user_id'];
        case 'star_count':
            return $this->_vars['comment_star_count'];
        case 'star_last':
            return $this->_vars['comment_star_last'];
        case 'star_lasttime':
            return $this->_vars['comment_star_lasttime'];
        case 'attachment_count':
            return $this->_vars['comment_attachment_count'];
        case 'attachment_last':
            return $this->_vars['comment_attachment_last'];
        case 'attachment_lasttime':
            return $this->_vars['comment_attachment_lasttime'];
        case 'Topic':
            return $this->_fetchTopic();
        case 'Parent':
            return $this->_fetchParent();
        case 'Stars':
            return $this->_fetchStars($limit, $offset, $sort, $order);
        case 'LastStar':
            return $this->_fetchLastStar();
        case 'Attachments':
            return $this->_fetchAttachments($limit, $offset, $sort, $order);
        case 'LastAttachment':
            return $this->_fetchLastAttachment();
        case 'User':
            return $this->_fetchUser();
        case 'UserWithData':
            return $this->_fetchUser(true);
        case 'Children':
            return $this->_fetchChildren();
default:
return isset($this->_objects[$name]) ? $this->_objects[$name] : null;
        }
    }

    protected function _set($name, $value, $markDirty)
    {
        switch ($name) {
        case 'id':
            $this->_setVar('comment_id', $value, $markDirty);
            break;
        case 'title':
            $this->_setVar('comment_title', $value, $markDirty);
            break;
        case 'body':
            $this->_setVar('comment_body', $value, $markDirty);
            break;
        case 'body_html':
            $this->_setVar('comment_body_html', $value, $markDirty);
            break;
        case 'body_filter_id':
            $this->_setVar('comment_body_filter_id', $value, $markDirty);
            break;
        case 'ip':
            $this->_setVar('comment_ip', $value, $markDirty);
            break;
        case 'host':
            $this->_setVar('comment_host', $value, $markDirty);
            break;
        case 'parent_id':
            $this->_setVar('comment_parent_id', $value, $markDirty);
            break;
        case 'topic_id':
            $this->_setVar('comment_topic_id', $value, $markDirty);
            break;
        case 'parent':
            $this->_setVar('comment_parent', $value, $markDirty);
            break;
        case 'user_id':
            $this->_setVar('comment_user_id', $value, $markDirty);
            break;
        case 'star_count':
            $this->_setVar('comment_star_count', $value, $markDirty);
            break;
        case 'star_last':
            $this->_setVar('comment_star_last', $value, $markDirty);
            break;
        case 'star_lasttime':
            $this->_setVar('comment_star_lasttime', $value, $markDirty);
            break;
        case 'attachment_count':
            $this->_setVar('comment_attachment_count', $value, $markDirty);
            break;
        case 'attachment_last':
            $this->_setVar('comment_attachment_last', $value, $markDirty);
            break;
        case 'attachment_lasttime':
            $this->_setVar('comment_attachment_lasttime', $value, $markDirty);
            break;
        case 'Topic':
            $entity = is_array($value) ? $value[0] : $value;
            $this->assignTopic($entity);
            break;
        case 'Parent':
            $entity = is_array($value) ? $value[0] : $value;
            $this->assignParent($entity);
            break;
        case 'Stars':
            $this->removeStars();
            foreach (array_keys($value) as $i) {
                $this->addStar($value[$i]);
            }
            break;
        case 'Attachments':
            $this->removeAttachments();
            foreach (array_keys($value) as $i) {
                $this->addAttachment($value[$i]);
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

abstract class Plugg_Forum_Model_Base_CommentRepository extends Sabai_Model_TreeEntityRepository
{
    public function __construct(Sabai_Model $model)
    {
        parent::__construct('Comment', $model);
    }

    public function fetchByUser($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('comment_user_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByUser($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('User', $id, $perpage, $sort, $order);
    }

    public function countByUser($id)
    {
        return $this->_countByForeign('comment_user_id', $id);
    }

    public function fetchByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('comment_user_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByUserAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('User', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByUserAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('comment_user_id', $id, $criteria);
    }

    public function fetchByTopic($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('comment_topic_id', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByTopic($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('Topic', $id, $perpage, $sort, $order);
    }

    public function countByTopic($id)
    {
        return $this->_countByForeign('comment_topic_id', $id);
    }

    public function fetchByTopicAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('comment_topic_id', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByTopicAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('Topic', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByTopicAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('comment_topic_id', $id, $criteria);
    }

    public function fetchByParent($id, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeign('comment_parent', $id, $limit, $offset, $sort, $order);
    }

    public function paginateByParent($id, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntity('Parent', $id, $perpage, $sort, $order);
    }

    public function countByParent($id)
    {
        return $this->_countByForeign('comment_parent', $id);
    }

    public function fetchByParentAndCriteria($id, Sabai_Model_Criteria $criteria, $limit = 0, $offset = 0, $sort = null, $order = null)
    {
        return $this->_fetchByForeignAndCriteria('comment_parent', $id, $criteria, $limit, $offset, $sort, $order);
    }

    public function paginateByParentAndCriteria($id, Sabai_Model_Criteria $criteria, $perpage = 10, $sort = null, $order = null)
    {
        return $this->_paginateByEntityAndCriteria('Parent', $id, $criteria, $perpage, $sort, $order);
    }

    public function countByParentAndCriteria($id, Sabai_Model_Criteria $criteria)
    {
        return $this->_countByForeignAndCriteria('comment_parent', $id, $criteria);
    }

    protected function _getCollectionByRowset(Sabai_DB_Rowset $rs)
    {
        return new Plugg_Forum_Model_Base_CommentsByRowset($rs, $this->_model->create('Comment'), $this->_model);
    }

    public function createCollection(array $entities = array())
    {
        return new Plugg_Forum_Model_Base_Comments($this->_model, $entities);
    }
}

class Plugg_Forum_Model_Base_CommentsByRowset extends Sabai_Model_EntityCollection_Rowset
{
    public function __construct(Sabai_DB_Rowset $rs, Plugg_Forum_Model_Comment $emptyEntity, Sabai_Model $model)
    {
        parent::__construct('Comments', $rs, $emptyEntity, $model);
    }

    protected function _loadRow(Sabai_Model_Entity $entity, array $row)
    {
        $entity->initVars($row);
        if (isset($row['level'])) {
            $entity->setParentsCount($row['level']);
        }
        $entity->left = $row['comment_tree_left'];
        $entity->right = $row['comment_tree_right'];
    }
}

class Plugg_Forum_Model_Base_Comments extends Sabai_Model_EntityCollection_Array
{
    public function __construct(Sabai_Model $model, array $entities = array())
    {
        parent::__construct($model, 'Comments', $entities);
    }
}