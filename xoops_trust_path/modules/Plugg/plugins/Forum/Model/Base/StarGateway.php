<?php
/*
This file has been generated by the Sabai scaffold script. Do not edit this file directly.
If you need to customize the class, use the following file:
pluginsy/Forum/Model/StarGateway.php
*/
abstract class Plugg_Forum_Model_Base_StarGateway extends Sabai_Model_Gateway
{
    public function getName()
    {
        return 'star';
    }

    public function getFields()
    {
        return array('star_id' => Sabai_Model::KEY_TYPE_INT, 'star_created' => Sabai_Model::KEY_TYPE_INT, 'star_updated' => Sabai_Model::KEY_TYPE_INT, 'star_topic_id' => Sabai_Model::KEY_TYPE_INT, 'star_comment_id' => Sabai_Model::KEY_TYPE_INT, 'star_user_id' => Sabai_Model::KEY_TYPE_INT);
    }

    protected function _getSelectByIdQuery($id, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sstar WHERE star_id = %d',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $id
        );
    }

    protected function _getSelectByIdsQuery($ids, $fields)
    {
        return sprintf(
            'SELECT %s FROM %sstar WHERE star_id IN (%s)',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            implode(',', array_map('intval', $ids))
        );
    }

    protected function _getSelectByCriteriaQuery($criteriaStr, $fields)
    {
        return sprintf(
            'SELECT %1$s FROM %2$sstar WHERE %3$s',
            empty($fields) ? '*' : implode(', ', $fields),
            $this->_db->getResourcePrefix(),
            $criteriaStr
        );
    }

    protected function _getInsertQuery($values)
    {
        $values['star_created'] = time();
        $values['star_updated'] = 0;
        return sprintf("INSERT INTO %sstar(star_created, star_updated, star_topic_id, star_comment_id, star_user_id) VALUES(%d, %d, %d, %d, %d)", $this->_db->getResourcePrefix(), $values['star_created'], $values['star_updated'], $values['star_topic_id'], $values['star_comment_id'], $values['star_user_id']);
    }

    protected function _getUpdateQuery($id, $values)
    {
        $last_update = $values['star_updated'];
        $values['star_updated'] = time();
        return sprintf("UPDATE %sstar SET star_updated = %d, star_topic_id = %d, star_comment_id = %d, star_user_id = %d WHERE star_id = %d AND star_updated = %d", $this->_db->getResourcePrefix(), $values['star_updated'], $values['star_topic_id'], $values['star_comment_id'], $values['star_user_id'], $id, $last_update);
    }

    protected function _getDeleteQuery($id)
    {
        return sprintf('DELETE FROM %1$sstar WHERE star_id = %2$d', $this->_db->getResourcePrefix(), $id);
    }

    protected function _getUpdateByCriteriaQuery($criteriaStr, $sets)
    {
        $sets['star_updated'] = 'star_updated=' . time();
        return sprintf('UPDATE %sstar SET %s WHERE %s', $this->_db->getResourcePrefix(), implode(',', $sets), $criteriaStr);
    }

    protected function _getDeleteByCriteriaQuery($criteriaStr)
    {
        return sprintf('DELETE FROM %1$sstar WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _getCountByCriteriaQuery($criteriaStr)
    {
        return sprintf('SELECT COUNT(*) FROM %1$sstar WHERE %2$s', $this->_db->getResourcePrefix(), $criteriaStr);
    }

    protected function _afterInsertTrigger1($id, $new)
    {
        if (!empty($new['star_topic_id'])) {
            $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count + 1, topic_star_last = %d, topic_star_lasttime = %d WHERE topic_id = %d', $this->_db->getResourcePrefix(), $id, $new['star_created'], $new['star_topic_id']));
        }
        if (!empty($new['star_comment_id'])) {
            $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count + 1, comment_star_last = %d, comment_star_lasttime = %d WHERE comment_id = %d', $this->_db->getResourcePrefix(), $id, $new['star_created'], $new['star_comment_id']));
        }
    }

    protected function _afterDeleteTrigger1($id, $old)
    {
        if (!empty($old['star_topic_id'])) {
            $sql = sprintf('SELECT star_id, star_created FROM %sstar WHERE star_topic_id = %d ORDER BY star_created DESC', $this->_db->getResourcePrefix(), $old['star_topic_id']);
            if (($rs = $this->_db->query($sql, 1, 0)) && ($rs->rowCount() > 0)) {
                $row = $rs->fetchAssoc();
                $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count - 1, topic_star_last = %d, topic_star_lasttime = %d WHERE topic_id = %d', $this->_db->getResourcePrefix(), $row['star_id'], $row['star_created'], $old['star_topic_id']));
            } else {
                $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count - 1, topic_star_last = 0, topic_star_lasttime = topic_created WHERE topic_id = %d', $this->_db->getResourcePrefix(), $old['star_topic_id']));
            }
        }
        if (!empty($old['star_comment_id'])) {
            $sql = sprintf('SELECT star_id, star_created FROM %sstar WHERE star_comment_id = %d ORDER BY star_created DESC', $this->_db->getResourcePrefix(), $old['star_comment_id']);
            if (($rs = $this->_db->query($sql, 1, 0)) && ($rs->rowCount() > 0)) {
                $row = $rs->fetchAssoc();
                $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count - 1, comment_star_last = %d, comment_star_lasttime = %d WHERE comment_id = %d', $this->_db->getResourcePrefix(), $row['star_id'], $row['star_created'], $old['star_comment_id']));
            } else {
                $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count - 1, comment_star_last = 0, comment_star_lasttime = comment_created WHERE comment_id = %d', $this->_db->getResourcePrefix(), $old['star_comment_id']));
            }
        }
    }

    protected function _afterUpdateTrigger1($id, $new, $old)
    {
        if (empty($old['star_topic_id']) && !empty($new['star_topic_id'])) {
            $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count + 1, topic_star_last = %d, topic_star_lasttime = %d WHERE topic_id = %d', $this->_db->getResourcePrefix(), $id, $new['star_created'], $new['star_topic_id']));
        } elseif (!empty($old['star_topic_id']) && empty($new['star_topic_id'])) {
            $sql = sprintf('SELECT star_id, star_created FROM %sstar WHERE star_topic_id = %d ORDER BY star_created DESC', $this->_db->getResourcePrefix(), $old['star_topic_id']);
            if (($rs = $this->_db->query($sql, 1, 0)) && ($rs->rowCount() > 0)) {
                $row = $rs->fetchAssoc();
                $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count - 1, topic_star_last = %d, topic_star_lasttime = %d WHERE topic_id = %d', $this->_db->getResourcePrefix(), $row['star_id'], $row['star_created'], $old['star_topic_id']));
            } else {
                $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count - 1, topic_star_last = 0, topic_star_lasttime = topic_created WHERE topic_id = %d', $this->_db->getResourcePrefix(), $old['star_topic_id']));
            }
        } elseif ($old['star_topic_id'] != $new['star_topic_id']) {
            $sql = sprintf('SELECT star_id, star_created FROM %sstar WHERE star_topic_id = %d ORDER BY star_created DESC', $this->_db->getResourcePrefix(), $old['star_topic_id']);
            if (($rs = $this->_db->query($sql, 1, 0)) && ($rs->rowCount() > 0)) {
                $row = $rs->fetchAssoc();
                $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count - 1, topic_star_last = %d, topic_star_lasttime = %d WHERE topic_id = %d', $this->_db->getResourcePrefix(), $row['star_id'], $row['star_created'], $old['star_topic_id']));
            } else {
                $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count - 1, topic_star_last = 0, topic_star_lasttime = topic_created WHERE topic_id = %d', $this->_db->getResourcePrefix(), $old['star_topic_id']));
            }
            $this->_db->exec(sprintf('UPDATE %stopic SET topic_star_count = topic_star_count + 1, topic_star_last = %d, topic_star_lasttime = %d WHERE topic_id = %d', $this->_db->getResourcePrefix(), $id, $new['star_created'], $new['star_topic_id']));
        }
        if (empty($old['star_comment_id']) && !empty($new['star_comment_id'])) {
            $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count + 1, comment_star_last = %d, comment_star_lasttime = %d WHERE comment_id = %d', $this->_db->getResourcePrefix(), $id, $new['star_created'], $new['star_comment_id']));
        } elseif (!empty($old['star_comment_id']) && empty($new['star_comment_id'])) {
            $sql = sprintf('SELECT star_id, star_created FROM %sstar WHERE star_comment_id = %d ORDER BY star_created DESC', $this->_db->getResourcePrefix(), $old['star_comment_id']);
            if (($rs = $this->_db->query($sql, 1, 0)) && ($rs->rowCount() > 0)) {
                $row = $rs->fetchAssoc();
                $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count - 1, comment_star_last = %d, comment_star_lasttime = %d WHERE comment_id = %d', $this->_db->getResourcePrefix(), $row['star_id'], $row['star_created'], $old['star_comment_id']));
            } else {
                $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count - 1, comment_star_last = 0, comment_star_lasttime = comment_created WHERE comment_id = %d', $this->_db->getResourcePrefix(), $old['star_comment_id']));
            }
        } elseif ($old['star_comment_id'] != $new['star_comment_id']) {
            $sql = sprintf('SELECT star_id, star_created FROM %sstar WHERE star_comment_id = %d ORDER BY star_created DESC', $this->_db->getResourcePrefix(), $old['star_comment_id']);
            if (($rs = $this->_db->query($sql, 1, 0)) && ($rs->rowCount() > 0)) {
                $row = $rs->fetchAssoc();
                $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count - 1, comment_star_last = %d, comment_star_lasttime = %d WHERE comment_id = %d', $this->_db->getResourcePrefix(), $row['star_id'], $row['star_created'], $old['star_comment_id']));
            } else {
                $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count - 1, comment_star_last = 0, comment_star_lasttime = comment_created WHERE comment_id = %d', $this->_db->getResourcePrefix(), $old['star_comment_id']));
            }
            $this->_db->exec(sprintf('UPDATE %scomment SET comment_star_count = comment_star_count + 1, comment_star_last = %d, comment_star_lasttime = %d WHERE comment_id = %d', $this->_db->getResourcePrefix(), $id, $new['star_created'], $new['star_comment_id']));
        }
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