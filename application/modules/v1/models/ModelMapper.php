<?php

class V1_Model_ModelMapper
{
    protected $_db_table;

    public function __construct()
    {
        $this->_db_table = new V1_Model_DbTable_Models();
    }

    public function save(V1_Model_Model $model)
    {
        $data = array(
            'id' => $model->id,
            'make_id' => $model->make_id,
            'name' => $model->model_id,
            'created_at' => $model->created_at,
            'modified_at' => $model->modified_at
        );

        // Remove created_at to prevent modification
        if (array_key_exists('created_at', $data)){
            unset($data['created_at']);
        }

        if (is_null($model->id)) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $this->_db_table->insert($data);
        } else {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $this->_db_table->update($data, array('id =?' => $model->id));
        }
    }

    public function getModelById($id)
    {
        // Use db_table to find model with $id
        $result = $this->_db_table->find($id);

        // Count results and if not found throw exception
        if (count($result) == 0) {
            throw new Exception ('model not found');
        }

        $row = $result->current();
        $model =  new V1_Model_Model($row);

        return $model;
    }

}