<?php

class V1_CarsController extends V1_Controller_Abstract
{
    public function indexAction()
    {
        // v1/cars/
        // Display all cars
        $cars = $this->mapper->getAllCars();

        $this->data['meta']['code'] = 200;
        foreach ($cars as $car) {
            $this->data['response'][] = $car->toArray();
        }
    }

    public function getAction()
    {
        // v1/cars/:id
        // Display one car
        $car = $this->mapper->getCarById($this->id);

        $this->data['meta']['code'] = 200;
        $this->data['response'][] = $car->toArray();
    }

    public function postAction()
    {
        // v1/cars
        // with data
        // Create a car
        $rawBody = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($rawBody);

        $car = new V1_Model_Car;
        $car->loadFromArray($data);
        $car = $this->mapper->save($car);

        $this->data['meta']['code'] = 201;
        $this->data['response'][] = $car->toArray();

    }

    public function putAction()
    {
        // v1/cars/:id
        // with data
        // Update a car
        $rawBody = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($rawBody);

        $car = $this->mapper->getCarById($this->id);

        $car->loadFromArray($data);
        $car = $this->mapper->save($car);

        $this->data['meta']['code'] = 200;
        $this->data['response'][] = $car->toArray();
    }

    public function deleteAction()
    {
        // v1/cars/:id
        // Delete a car
        $car = $this->mapper->deleteById($this->id);
        $this->data['meta'] = array('code' => 200);
        $this->data['response'] = array();
    }

    public function headAction()
    {
        // Return only headers for a request
        // // v1/cars/:id
        // Display one car
    }
}