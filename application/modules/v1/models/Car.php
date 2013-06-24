<?php

class V1_Model_Car extends V1_Model_Abstract
{
    protected $_model_id;
    protected $_production_year;
    protected $_reg_number;

    public function __construct($row = null)
    {
        if (!is_null($row) and $row instanceof Zend_Db_Table_Row) {
            $this->_id = $row->id;
            $this->_model_id = $row->model_id;
            $this->_production_year = $row->production_year;
            $this->_reg_number = $row->reg_number;
            $this->_created_at = $row->created_at;
            $this->_modified_at = $row->modified_at;
        }
    }
}