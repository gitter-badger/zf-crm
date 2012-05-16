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
    		$mapper = new CRM_Model_TicketsMapper();
    		$cMapper = new CRM_Model_CustomersMapper();
    		$uMapper = new CRM_Model_UsersMapper();
    		$this->view->customers = $cMapper->fetchAllForTickets();
    		$this->view->users = $uMapper->fetchAllForTickets();
    		$this->view->entries = $mapper->fetchOpen();
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
    		$form->addElement('hidden','cguid',array("value"=>$uguid));
    		if($this->getRequest()->getPost()){
    			if($form->isValid($this->getRequest()->getPost())){
    				$t = new CRM_Model_Tickets($form->getValues());
    				$mapper = new CRM_Model_TicketsMapper();
    				$mapper->save($t);
    				$this->_helper->redirector->gotoUrl('/tickets');
    			} 
    		} else {
    			$this->view->headScript()->appendScript("$(function() {
		$('.datePicker').datepicker();
	});");
    			$form->removeDecorator('htmlTag');
    			$this->view->form = $form;
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }
    
    public function historyAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$cguid = $this->getRequest()->getParam('guid');
    		$tMapper = new CRM_Model_TicketsMapper();
    		$cMapper = new CRM_Model_CustomersMapper();
    		$uMapper = new CRM_Model_UsersMapper();
    		$this->view->customers = $cMapper->fetchAll();
    		$this->view->users = $uMapper->fetchAll();
    		$this->view->entries = $tMapper->fetchAllByCGuid($cguid);
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }
    
    public function editAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$guid = $this->getRequest()->getParam('guid');
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    	
    }
    public function assignedAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$user = $auth->getIdentity();
    		$mapper = new CRM_Model_TicketsMapper();
    		$cMapper = new CRM_Model_CustomersMapper();
    		$this->view->customers = $cMapper->fetchAllForTickets();
    		$this->view->entries = $mapper->fetchAllByUGuid($user['userid']);
    		
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }
    
    public function grabAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$user = $auth->getIdentity();
    		$tguid = $this->getRequest()->getParam('guid');
    		$mapper = new CRM_Model_TicketsMapper();
    		if($mapper->assignByUguid($tguid, $user['userid'])){
    			$this->_helper->redirector->gotoUrl('/tickets/assigned');
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }
    
    public function closeAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$tguid = $this->getRequest()->getParam('guid');
    		$tMapper = new CRM_Model_TicketsMapper();
    		if($tMapper->closeByGuid($tguid)){
    			$this->view->messages = "<div class='alert alert-success'><h4 class='alert-heading'>Success!</h4>Closed ticket successfully.</div>";
    		} else {
    			$this->view->messages = "<div class='alert alert-error'><h4 class='alert-heading'>Error!</h4>Error closing ticket.</div>";
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }


}



