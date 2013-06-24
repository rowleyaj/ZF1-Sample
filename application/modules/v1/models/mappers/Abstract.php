<?php

abstract class V1_Model_Mapper_Abstract
{
    protected $_db_table;

    protected function _getById($id)
    {
        // Use db_table to find by $id
        $result = $this->_db_table->find($id);

        // Count results and if not found throw exception
        if (count($result) == 0) {
            throw new Zend_Exception('Item Not found', 404);
        }

        $row = $result->current();

        return $row;
    }

    protected function _getAll($limit = 25, $offset = 0)
    {
        $select = $this->_db_table
            ->select()
            ->limit(':limit', ':offset')
            ->bind(array(
                ':limit' => $limit,
                ':offset' => $offset)
            );

        $rowset = $this->_db_table->fetchAll($select);
        return $rowset;
    }

    public function deleteById($id)
    {
        $where = $this->_db_table->getAdapter()->quoteInto('id = ?', $id);
        $this->_db_table->delete($where);
    }
}