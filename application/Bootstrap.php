<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initModules()
    {
        $front = Zend_Controller_Front::getInstance();

        $front->addModuleDirectory(APPLICATION_PATH . '/modules');
        // $front->setDefaultModule('v1');

    }

    public function _initRoutes()
    {
        $front = Zend_Controller_Front::getInstance();

        $router = $front->getRouter();
        $route = new Zend_Rest_Route($front, array(), array('v1'));

        $router->addRoute('v1', $route);
    }

    public function _initAutoload()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'basePath'  => APPLICATION_PATH . '/modules/v1',
            'namespace' => 'V1'
        ));
    }
}

