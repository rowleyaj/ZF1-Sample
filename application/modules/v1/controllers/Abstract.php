<?php

abstract class V1_Controller_Abstract extends Zend_Rest_Controller
{
    protected $modelName;
    protected $mapper;
    protected $id;
    protected $data;

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);

        $class = get_called_class();
        $regex = '/V1_|sController/';
        $modelName = preg_replace($regex, '', $class);
        $mapper = 'V1_Model_Mapper_' . $modelName;

        $this->mapper = new $mapper;
        $this->modelName = $modelName;

        $this->id = $this->_getParam('id');
    }

    public function postDispatch() {
        $this->getResponse()
             ->setHttpResponseCode($this->data['meta']['code']);

        $lpmodel = strtolower($this->modelName);
        $response = $this->data['response'];
        unset($this->data['response']);

        $count = count($response);
        $this->data['response'][$lpmodel.'s'] = array(
            'count' => $count,
            'items' => $response);

        $this->_helper->json($this->data);
    }
}