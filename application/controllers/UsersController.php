<?php

class UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$this->view->headScript()->appendScript("$('.dropdown-toggle').dropdown();");
    		$mapper = new CRM_Model_UsersMapper();
    		$rmapper = new CRM_Model_RolesMapper();
    		$this->view->roles = $rmapper->fetchArray();
    		$this->view->entries = $mapper->fetchAll();
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    	
    }

    public function addAction()
    {
        // action body
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$this->view->headScript()->appendScript("$('.dropdown-toggle').dropdown();");
    		$form = new CRM_Form_User();
    		if($this->getRequest()->getPost()){
    			if($form->isValid($this->getRequest()->getPost())){
	    			//$arrValues = $this->getRequest()->getPost();
	    			$user = new CRM_Model_Users($form->getValues());
	    			$mapper = new CRM_Model_UsersMapper();
	    			$mapper->save($user);
	    			$this->_helper->redirector->gotoUrl('/users');
    			}
    		} else {
	        	$this->view->form = $form;
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}	
    }

    public function editAction()
    {
    // action body
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$this->view->headScript()->appendScript("$('.dropdown-toggle').dropdown();");
    		$form = new CRM_Form_UserEdit();
    		$user = new CRM_Model_Users();
    		$mapper = new CRM_Model_UsersMapper();
    		if($this->getRequest()->getPost()){
    			$arrValues = $this->getRequest()->getPost();
    		} else {
    			$mapper->findByGuid($this->_getParam('guid'), $user);
    			$form->setElementFilters(array());
    			$this->_repopulateForm($form, $user);
	        	$this->view->form = $form;
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}	
    }

    public function deleteAction()
    {
    // action body
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$this->view->headScript()->appendScript("$('.dropdown-toggle').dropdown();");
    		$mapper = new CRM_Model_UsersMapper();
    		if($mapper->delete($this->_getParam('guid'))){
    			$this->_helper->redirector->gotoUrl('/users');
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}	
    }
    
    protected function _repopulateForm($form, $entry)
    {
    	$values = array(
    			'id'   		=> $entry->id,
    			'guid' 		=> $entry->guid,
    			'rguid'		=> $entry->rguid,
    			'username'	=> $entry->username,
    			'pwd'		=> $entry->pwd,
    			'name' 		=> $entry->name,
    			'email'		=> $entry->email
    	);
    	//print_r($values);
    	$form->populate($values);
    }


}







