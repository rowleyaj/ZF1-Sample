<?php

class V1_MakesController extends V1_Controller_Abstract
{
    public function indexAction()
    {
        // v1/makes/
        // Display all makes
        $makes = $this->mapper->getAllMakes();

        $this->data['meta']['code'] = 200;
        foreach ($makes as $make) {
            $this->data['response'][] = $make->toArray();
        }
    }

    public function getAction()
    {
        // v1/makes/:id
        // Display one make
        $make = $this->mapper->getMakeById($this->id);

        $this->data['meta']['code'] = 200;
        $this->data['response'][] = $make->toArray();
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

        $this->data['meta']['code'] = 201;
        $this->data['response'][] = $make->toArray();

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

        $this->data['meta']['code'] = 200;
        $this->data['response'][] = $make->toArray();
    }

    public function deleteAction()
    {
        // v1/makes/:id
        // Delete a make
        $make = $this->mapper->deleteById($this->id);
        $this->data['meta'] = array('code' => 200);
        $this->data['response'] = array();
    }

    public function headAction()
    {
        // Return only headers for a request
        // // v1/makes/:id
        // Display one make
    }
}