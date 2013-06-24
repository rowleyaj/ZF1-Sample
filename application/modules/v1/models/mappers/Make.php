<?php

class V1_Model_Mapper_Make extends V1_Model_Mapper_Abstract
{
    public function __construct()
    {
        $this->_db_table = new V1_Model_DbTable_Makes();
    }

    public function save(V1_Model_Make $make)
    {
        $data = array();

        $data = array(
            'id' => (int) $make->_id,
            'name' => $make->_name,
            'created_at' => $make->_created_at,
            'modified_at' => $make->_modified_at
        );

        // Remove created_at to prevent modification
        if (array_key_exists('created_at', $data)){
            unset($data['created_at']);
        }

        if (is_null($make->_id)) {
            date_default_timezone_set('UTC');
            $now = date('Y-m-d H:i:s');
            $data['created_at'] = $now;
            $data['modified_at'] = $now;
            $this->_db_table->insert($data);
            $id = $this->_db_table->getAdapter()->lastInsertId();
            $make->_id = $id;
            $make->_created_at = $now;
            $make->_modified_at = $now;

        } else {
            date_default_timezone_set('UTC');
            $now = date('Y-m-d H:i:s');
            $data['modified_at'] = $now;
            $this->_db_table->update($data, array('id =?' => $make->_id));
            $make->_modified_at = $now;
        }

        return $make;
    }

    public function getMakeById($id)
    {
        $row = $this->_getById($id);
        $make =  new V1_Model_Make($row);

        return $make;
    }

    public function getAllMakes()
    {
        $rowset = $this->_getAll();
        $makes = array();

        foreach ($rowset as $row) {
            $makes[] = new V1_Model_Make($row);
        }

        return $makes;
    }
}

