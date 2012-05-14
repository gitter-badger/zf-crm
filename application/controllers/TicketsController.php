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
    		$uguid = $this->getRequest()->getParam('guid');
    		$cMapper = new CRM_Model_CustomersMapper();
    		$this->view->customer = $cMapper->findByGuid($uguid);
    		$form = new CRM_Form_AddTicket();
    		if($this->getRequest()->getPost()){
    			
    		} else {
    			$this->view->headScript()->appendScript("$(function() {
		$('.datePicker').datepicker();
	});");
    			$form->addElement('hidden','cguid',array("value"=>$uguid));
    			$this->view->form = $form;
    		}
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



