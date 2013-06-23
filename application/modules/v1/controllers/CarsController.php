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
    }

    public function getAction()
    {
        // v1/cars/:id
        // Display one car
        $car = $this->mapper->getCarById($this->id);
        $this->getResponse()->setBody(var_dump($car));
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function postAction()
    {
        // v1/cars
        // with data
        // Create a car
    }

    public function putAction()
    {
        // v1/cars/:id
        // with data
        // Update a car
    }

    public function deleteAction()
    {
        // v1/cars/:id
        // Delete a car
    }

    public function headAction()
    {
        // Return only headers for a request
        // // v1/cars/:id
        // Display one car
    }
}

