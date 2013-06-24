<?php

class V1_Model_Model extends V1_Model_Abstract
{
    protected $_make_id;
    protected $_name;

    public function __construct($row = null)
    {
        if (!is_null($row) and $row instanceof Zend_Db_Table_Row) {
            $this->_id = $row->id;
            $this->_make_id = $row->make_id;
            $this->_name = $row->name;
            $this->_created_at = $row->created_at;
            $this->_modified_at = $row->modified_at;
        }
    }
}