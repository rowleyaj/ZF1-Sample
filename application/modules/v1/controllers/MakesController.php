<?php

class V1_MakesController extends Zend_Rest_Controller
{
    protected $mapper;
    protected $id;

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->mapper = new V1_Model_Mapper_Make;
        $this->id = $this->_getParam('id');
    }

    public function indexAction()
    {
        // v1/makes/
        // Display all makes
        $makes = $this->mapper->getAllMakes();

        $json = '{ "response":[';
        foreach ($makes as $make) {
            $json .= Zend_Json::encode($make);
            $json .= ',';
        }
        $json = trim($json, ',');
        $json .= ']}';

        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);

    }

    public function getAction()
    {
        // v1/makes/:id
        // Display one make
        $make = $this->mapper->getMakeById($this->id);

        $json = Zend_Json::encode($make);

        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function postAction()
    {
        // v1/makes
        // with data
        // Create a make
        $rawBody = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($rawBody);

        $make = new V1_Model_Make;
        $make->loadFromArray($data);
        $make = $this->mapper->save($make);

        $json = Zend_Json::encode($make);
        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(201);

    }

    public function putAction()
    {
        // v1/makes/:id
        // with data
        // Update a make
        $rawBody = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($rawBody);

        $make = $this->mapper->getMakeById($this->id);

        $make->loadFromArray($data);
        $make = $this->mapper->save($make);

        $json = Zend_Json::encode($make);
        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function deleteAction()
    {
        // v1/makes/:id
        // Delete a make
        $make = $this->mapper->deleteById($this->id);
        $this->getResponse()->setHttpResponseCode(204);
    }

    public function headAction()
    {
        // Return only headers for a request
        // // v1/makes/:id
        // Display one make
    }
}