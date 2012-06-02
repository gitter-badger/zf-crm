<?php

class CustomersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$mapper = new CRM_Model_CustomersMapper();
    		$this->view->entries = $mapper->fetchAll();
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }

    public function addAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$form = new CRM_Form_AddCustomer();
    		if($this->getRequest()->getPost()){
    			// form submitted
    			if($form->isValid($this->getRequest()->getPost())){
    				//$arrValues = $this->getRequest()->getPost();
    				$c = new CRM_Model_Customers($form->getValues());
    				$mapper = new CRM_Model_CustomersMapper();
    				$cguid = $mapper->save($c);
    				//$this->_helper->redirector->gotoUrl('/customers');
    				$this->view->messages = "<div class='alert alert-success'><h4 class='alert-heading'>Success!</h4>Successfully added a customer click <a href='/tickets/add/guid/".$cguid."'>here</a> to add a ticket.</div>";
    			} 
    		} else {
    			$form->removeDecorator('htmlTag');
    			$this->view->form = $form;
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }
    
    public function deleteAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$guid = $this->getRequest()->getParam('guid');
    		$mapper = new CRM_Model_CustomersMapper();
    		$mapper->deleteByGuid($guid);
    		$this->_helper->redirector->gotoUrl('/customers');
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }

    public function editAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$mapper = new CRM_Model_CustomersMapper();
    		$form = new CRM_Form_EditCustomer();
    		if($this->getRequest()->getPost()){
    			$c = new CRM_Model_Customers($this->getRequest()->getPost());
    			$c->setGuid($this->getRequest()->getPost('guid'));
    			$cguid = $mapper->save($c);
    			$this->view->messages = "<div class='alert alert-info'><h4 class='alert-heading'>Success!</h4>Successfully UPDATED a customer click <a href='/tickets/add/guid/".$this->getRequest()->getPost('guid')."'>here</a> to add a ticket.</div>";
    		} else {
    			$guid = $this->getRequest()->getParam('guid');
    			$customer = $mapper->findByGuid($guid);
    			$form->setElementFilters(array());
    			$this->_repopulateForm($form, $customer);
    			$form->removeDecorator('htmlTag');
	        	$this->view->form = $form;
    		}
    		// Uncomment below after save is successful
    		//$this->_helper->redirector->gotoUrl('/customers');
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }
    
    public function labelsAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		$this->_helper->layout->disableLayout();
    		$this->_helper->viewRenderer->setNeverRender();
    		$mapper = new CRM_Model_CustomersMapper();
    		$arrCustomers = $mapper->fetchAll();
    		
    		header('Content-type: text/csv');
    		header('Content-Disposition: attachment;filename=labels.csv');
    		$fp = fopen('php://output','w');
    		fputcsv($fp,array('FirstName','LastName','Address1','Address2','City','State','Zip'));
    		foreach($arrCustomers as $object){
    			$arrRow = $object->toLabels();
    			fputcsv($fp, $arrRow);
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
    			'fname'		=> $entry->fname,
    			'lname'		=> $entry->lname,
    			'address1'	=> $entry->address1,
    			'address2'  => $entry->address2,
    			'city'		=> $entry->city,
    			'state'		=> $entry->state,
    			'zip'		=> $entry->zip,
    			'phone'		=> $entry->phone,
    			'mobile'	=> $entry->mobile,
    	);
    	//print_r($values);
    	$form->populate($values);
    }

}





