<?php

abstract class V1_Model_Abstract
{
    protected $_id;
    protected $_created_at;
    protected $_modified_at;

    abstract public function __construct($row = null);

    public function __set($name, $value)
    {
        switch($name) {
            case 'id':
                if (!is_null($this->_id)) {
                    throw new Exception('Can not update id');
                }
                break;
            case 'created_at':
                if (!is_null($this->_created_at)) {
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