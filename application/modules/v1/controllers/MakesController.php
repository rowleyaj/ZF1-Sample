<?php

class V1_MakesController extends Zend_Rest_Controller
{

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        // v1/makes/
        // Display all makes
    }

    public function getAction()
    {
        // v1/makes/:id
        // Display one make
    }

    public function postAction()
    {
        // v1/makes
        // with data
        // Create a make
    }

    public function putAction()
    {
        // v1/makes/:id
        // with data
        // Update a make
    }

    public function deleteAction()
    {
        // v1/makes/:id
        // Delete a make
    }

    public function headAction()
    {
        // Return only headers for a request
    }
}

