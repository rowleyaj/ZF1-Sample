<?php

class V1_ModelsController extends V1_Controller_Abstract
{
    public function indexAction()
    {
        // v1/models/
        // Display all models
        $models = $this->mapper->getAllModels();

        $this->data['meta']['code'] = 200;
        foreach ($models as $model) {
            $this->data['response'][] = $model->toArray();
        }
    }

    public function getAction()
    {
        // v1/models/:id
        // Display one model
        $model = $this->mapper->getModelById($this->id);

        $this->data['meta']['code'] = 200;
        $this->data['response'][] = $model->toArray();
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

        $this->data['meta']['code'] = 201;
        $this->data['response'][] = $model->toArray();

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

        $this->data['meta']['code'] = 200;
        $this->data['response'][] = $model->toArray();
    }

    public function deleteAction()
    {
        // v1/models/:id
        // Delete a model
        $model = $this->mapper->deleteById($this->id);
        $this->data['meta'] = array('code' => 200);
        $this->data['response'] = array();
    }

    public function headAction()
    {
        // Return only headers for a request
        // // v1/models/:id
        // Display one model
    }
}