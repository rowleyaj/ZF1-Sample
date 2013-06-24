<?php

class V1_Model_Mapper_Model extends V1_Model_Mapper_Abstract
{
    public function __construct()
    {
        $this->_db_table = new V1_Model_DbTable_Models();
    }

    public function save(V1_Model_Model $model)
    {
        $data = array();

        $data = array(
            'id' => (int) $model->_id,
            'make_id' => (int) $model->_make_id,
            'name' => $model->_name,
            'created_at' => $model->_created_at,
            'modified_at' => $model->_modified_at
        );

        // Remove created_at to prevent modification
        if (array_key_exists('created_at', $data)){
            unset($data['created_at']);
        }

        if (is_null($model->_id)) {
            date_default_timezone_set('UTC');
            $now = date('Y-m-d H:i:s');
            $data['created_at'] = $now;
            $data['modified_at'] = $now;
            $this->_db_table->insert($data);
            $id = $this->_db_table->getAdapter()->lastInsertId();
            $model->_id = $id;
            $model->_created_at = $now;
            $model->_modified_at = $now;

        } else {
            date_default_timezone_set('UTC');
            $now = date('Y-m-d H:i:s');
            $data['modified_at'] = $now;
            $this->_db_table->update($data, array('id =?' => $model->_id));
            $model->_modified_at = $now;
        }

        return $model;
    }

    public function getModelById($id)
    {
        $row = $this->_getById($id);
        $model = new V1_Model_Model($row);
        $make = $row->findParentRow('V1_Model_DbTable_Makes');

        $model->make = $make->toArray();

        return $model;
    }

    public function getAllModels()
    {
        $rowset = $this->_getAll();
        $models = array();

        foreach ($rowset as $row) {
            $models[] = new V1_Model_Model($row);
        }

        return $models;
    }
}