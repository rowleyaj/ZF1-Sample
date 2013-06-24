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
            case '_id':
                if (!is_null($this->_id)) {
                    throw new Exception('Can not update id');
                }
                break;
            case '_created_at':
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

    public function loadFromArray(array $data)
    {
        foreach ($data as $key => $value) {
            if ($key !== 'id' and $key !== 'created_at' and $key !== 'modified_at'){
                $key = '_' . $key;
                $this->$key = $value;
            }
        }
    }

    public function toJson()
    {
        $array = (array) $this;
        $class = get_called_class();
        $regex = '/(\W|^)(' . $class . '|\*|_)/';

        foreach ($array as $key => $value) {
            unset($array[$key]);
            $key = preg_replace($regex, '', $key);
            $array[$key] = $value;
        }

        $json = '{';
        foreach ($array as $key => $value) {
            $json .= "\"$key\": \"$value\",";
        }
        $json = trim($json, ',');
        $json .= '}';

        return $json;
    }
}