<?php

class ErrorController extends Zend_Controller_Action
{
    protected $data;

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function postDispatch() {
        $this->data['meta']['code'] = $this->getResponse()->getHttpResponseCode();
        $this->data['meta']['errorDetail'] = $this->view->message;

        $this->_helper->json($this->data);
    }

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'You have reached the error page';
            return;
        }

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = 'Endpoint not found';
                break;
            default:
                // application error
                $code = $errors->exception->getCode();
                if (!is_null($code)) {
                    $this->getResponse()->setHttpResponseCode($code);
                    $priority = Zend_Log::NOTICE;
                } else {
                    $this->getResponse()->setHttpResponseCode(500);
                    $priority = Zend_Log::CRIT;
                }
                $this->view->message = $errors->exception->getMessage();
                break;
        }

        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }

        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        $this->view->request   = $errors->request;
    }

    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }


}
