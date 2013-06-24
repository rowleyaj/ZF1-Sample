<?php

class V1_Model_Mapper_Car extends V1_Model_Mapper_Abstract
{
    public function __construct()
    {
        $this->_db_table = new V1_Model_DbTable_Cars();
    }

    public function save(V1_Model_Car $car)
    {
        $data = array();

        $data = array(
            'id' => (int) $car->_id,
            'model_id' => (int) $car->_model_id,
            'production_year' => $car->_production_year,
            'reg_number' => $car->_reg_number,
            'created_at' => $car->_created_at,
            'modified_at' => $car->_modified_at
        );

        // Remove created_at to prevent modification
        if (array_key_exists('created_at', $data)){
            unset($data['created_at']);
        }

        if (is_null($car->_id)) {
            date_default_timezone_set('UTC');
            $now = date('Y-m-d H:i:s');
            $data['created_at'] = $now;
            $data['modified_at'] = $now;
            $this->_db_table->insert($data);
            $id = $this->_db_table->getAdapter()->lastInsertId();
            $car->_id = $id;
            $car->_created_at = $now;
            $car->_modified_at = $now;

        } else {
            date_default_timezone_set('UTC');
            $now = date('Y-m-d H:i:s');
            $data['modified_at'] = $now;
            $this->_db_table->update($data, array('id =?' => $car->_id));
            $car->_modified_at = $now;
        }

        return $car;
    }

    public function getCarById($id)
    {
        $row = $this->_getById($id);
        $car =  new V1_Model_Car($row);
        $model = $row->findParentRow('V1_Model_DbTable_Models');
        $make = $model->findParentRow('V1_Model_DbTable_Makes');

        $car->model = $model->toArray();
        $car->make = $make->toArray();

        return $car;
    }

    public function getAllCars()
    {
        $rowset = $this->_getAll();
        $cars = array();

        foreach ($rowset as $row) {
            $cars[] = new V1_Model_Car($row);
        }

        return $cars;
    }
}

