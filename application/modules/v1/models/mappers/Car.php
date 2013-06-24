<?php

class V1_Model_Mapper_Car extends V1_Model_Mapper_Abstract
{
    public function __construct()
    {
        $this->_db_table = new V1_Model_DbTable_Cars();
    }

    public function save(V1_Model_Car $car)
    {
        $data = array(
            'id' => $car->id,
            'model_id' => $car->model_id,
            'reg_number' => $car->reg_number,
            'created_at' => $car->created_at,
            'modified_at' => $car->modified_at
        );

        // Remove created_at to prevent modification
        if (array_key_exists('created_at', $data)){
            unset($data['created_at']);
        }

        if (is_null($car->id)) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            $this->_db_table->insert($data);
        } else {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $this->_db_table->update($data, array('id =?' => $car->id));
        }
    }

    public function getCarById($id)
    {
        $row = $this->_getById($id);
        $car =  new V1_Model_Car($row);

        return $car;
    }

    public function getAllCars()
    {
        $rowset = $this->_getAll();
        $cars = array();

        foreach ($rowset as $row) {
            $cars[] = new V1_Model_Car($row);
        }
    }



}

