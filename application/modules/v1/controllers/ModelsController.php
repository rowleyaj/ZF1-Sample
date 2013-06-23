<?php

class V1_ModelsController extends Zend_Rest_Controller
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        // v1/models/
        // Display all models
    }

    public function getAction()
    {
        // v1/models/:id
        // Display one make
    }

    public function postAction()
    {
        // v1/models
        // with data
        // Create a make
    }

    public function putAction()
    {
        // v1/models/:id
        // with data
        // Update a make
    }

    public function deleteAction()
    {
        // v1/models/:id
        // Delete a make
    }

    public function headAction()
    {
        // Return only headers for a request
    }
}

