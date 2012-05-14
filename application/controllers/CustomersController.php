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
    				$mapper->save($c);
    				$this->_helper->redirector->gotoUrl('/customers');
    			} else {
    				var_dump($this->getRequest()->getPost());
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





