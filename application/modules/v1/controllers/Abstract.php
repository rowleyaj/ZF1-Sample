<?php

abstract class V1_Controller_Abstract extends Zend_Rest_Controller
{
    protected $modelName;
    protected $mapper;
    protected $id;

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
}