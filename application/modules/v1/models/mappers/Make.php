<?php

class V1_Model_Mapper_Make extends V1_Model_Mapper_Abstract
{
    public function __construct()
    {
        $this->_db_table = new V1_Model_DbTable_Makes();
    }

    public function save(V1_Model_Make $make)
    {
        $data = array(
            'id' => $make->id,
            'name' => $make->model_id,
            'created_at' => $make->created_at,
            'modified_at' => $make->modified_at
        );

        // Remove created_at to prevent modification
        if (array_key_exists('created_at', $data)){
            unset($data['created_at']);
        }

        if (is_null($make->id)) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $this->_db_table->insert($data);
        } else {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $this->_db_table->update($data, array('id =?' => $make->id));
        }
    }

    public function getMakeById($id)
    {
        $row = $this->_getById($id);
        $make =  new V1_Model_Make($row);

        return $make;
    }

}