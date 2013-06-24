<?php

class V1_ModelsController extends V1_Controller_Abstract
{
    public function indexAction()
    {
        // v1/models/
        // Display all models
        $models = $this->mapper->getAllModels();

        $json = '{ "response":[';
        foreach ($models as $model) {
            $json .= Zend_Json::encode($model);
            $json .= ',';
        }
        $json = trim($json, ',');
        $json .= ']}';

        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);

    }

    public function getAction()
    {
        // v1/models/:id
        // Display one model
        $model = $this->mapper->getModelById($this->id);

        $json = Zend_Json::encode($model);

        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function postAction()
    {
        // v1/models
        // with data
        // Create a model
        $rawBody = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($rawBody);

        $model = new V1_Model_Model;
        $model->loadFromArray($data);
        $model = $this->mapper->save($model);

        $json = Zend_Json::encode($model);
        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(201);

    }

    public function putAction()
    {
        // v1/models/:id
        // with data
        // Update a model
        $rawBody = $this->getRequest()->getRawBody();
        $data = Zend_Json::decode($rawBody);

        $model = $this->mapper->getModelById($this->id);

        $model->loadFromArray($data);
        $model = $this->mapper->save($model);

        $json = Zend_Json::encode($model);
        $this->getResponse()->setBody($json);
        $this->getResponse()->setHttpResponseCode(200);
    }

    public function deleteAction()
    {
        // v1/models/:id
        // Delete a model
        $model = $this->mapper->deleteById($this->id);
        $this->getResponse()->setHttpResponseCode(204);
    }

    public function headAction()
    {
        // Return only headers for a request
        // // v1/models/:id
        // Display one model
    }
}