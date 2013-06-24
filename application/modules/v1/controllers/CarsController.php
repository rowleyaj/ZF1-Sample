<?php

class V1_CarsController extends Zend_Rest_Controller
{
    protected $mapper;
    protected $id;

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->mapper = new V1_Model_Mapper_Car;
        $this->id = $this->_getParam('id');
    }

    public function indexAction()
    {
        // v1/cars/
        // Display all cars
        $cars = $this->mapper->getAllCars();

        $json = '{ "response":[';
        foreach ($cars as $car) {
            $json .= Zend_Json::encode($car);
            $json .= ',';
        }
        $json = trim($json, ',');
        $json .= ']}';

        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);

    }

    public function getAction()
    {
        // v1/cars/:id
        // Display one car
        $car = $this->mapper->getCarById($this->id);

        $json = Zend_Json::encode($car);

        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);
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

        $json = Zend_Json::encode($car);
        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(201);

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

        $json = Zend_Json::encode($car);
        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function deleteAction()
    {
        // v1/cars/:id
        // Delete a car
        $car = $this->mapper->deleteById($this->id);
        $this->getResponse()->setHttpResponseCode(204);
    }

    public function headAction()
    {
        // Return only headers for a request
        // // v1/cars/:id
        // Display one car
    }
}