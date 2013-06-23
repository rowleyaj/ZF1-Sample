<?php

class V1_Model_Car
{
    private $id;
    private $model_id;
    private $production_year;
    private $reg_number;
    private $created_at;
    private $modified_at;

    public function __construct($row = null)
    {
        if (!is_null($row) and $row instanceof Zend_Db_Table_Row) {
            $this->id = $row->id;
            $this->model_id = $row->model_id;
            $this->production_year = $row->production_year;
            $this->reg_number = $row->reg_number;
            $this->created_at = $row->created_at;
            $this->modified_at = $row->modified_at;
        }
    }

    public function __set($name, $value)
    {
        switch($name) {
            case 'id':
                if (!is_null($this->id)) {
                    throw new Exception('Can not update id');
                }
                break;
            case 'created_at':
                if (!is_null($this->created_at)) {
                    throw new Exception('Can not update created_at');
                }
                break;
        }

        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}