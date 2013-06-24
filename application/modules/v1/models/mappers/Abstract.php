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
            throw new Exception ('Not found');
        }

        $row = $result->current();

        return $row;
    }

    protected function _getAll()
    {
        $rowset = $this->_db_table->fetchAll();

        return $rowset;
    }

}