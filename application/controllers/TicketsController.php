<?php

class TicketsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }
    
    public function addAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$uguid = $this->__getParam('guid');
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }

    public function assignedAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }


}



