<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initRoutes()
    {
        $front = Zend_Controller_Front::getInstance();

        $router = $front->getRouter();
        $route = new Zend_Rest_Route($front, array(), array('v1'));

        $router->addRoute('v1', $route);
    }

}

