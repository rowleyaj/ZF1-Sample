<?php

class V1_CarsController extends Zend_Rest_Controller
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
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
    }
}

