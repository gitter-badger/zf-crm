<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		// Authenticated User
    		$search = new CRM_Form_Search();
        	$search->removeDecorator('htmlTag');
    		$this->view->search = $search;
    	} else {
    		// Non-Authenticated User
        	$form = new CRM_Form_Login();
        	$form->removeDecorator('htmlTag');
        	$this->view->form = $form;
    	}
    }
    
    public function resultsAction()
    {
    	//$search = new CRM_Form_Search();
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity()){
    		if($this->getRequest()->getPost()){
    			if("customer" === $this->getRequest()->getPost('searchtype')){
    				$this->view->iscustomer = true;
	    			// Search Customers based on keyword
	    			$mapper = new CRM_Model_CustomersMapper();
	    			$this->view->entries = $mapper->findByKeyword($this->getRequest()->getPost('keyword'));
    			} else {
    				$this->view->iscustomer = false;
    				// Search Tickets based on keyword
    				$mapper = new CRM_Model_TicketsMapper();
    				$cMapper = new CRM_Model_CustomersMapper();
    				$uMapper = new CRM_Model_UsersMapper();
    				$this->view->customers = $cMapper->fetchAllForTickets();
    				$this->view->users = $uMapper->fetchAllForTickets();
    				if("otickets" === $this->getRequest()->getPost('searchtype')){
    					// Open Tickets
    					$this->view->entries = $mapper->findByKeyword($this->getRequest()->getPost('keyword'));
    					$this->view->ticket = "Open";
    				} else {
    					// Closed Tickets
    					$this->view->entries = $mapper->findByKeyword($this->getRequest()->getPost('keyword'),0);
    					$this->view->ticket = "Closed";
    				}
    			}
    		}
    	} else {
    		$this->_helper->redirector->gotoUrl('/');
    	}
    }

    public function loginAction()
    {
    	$form = new CRM_Form_Login();
    	if($this->getRequest()->getPost()){
    		$arrValues = $this->getRequest()->getPost();
    		$user = new CRM_Model_Users();
    		$mapper = new CRM_Model_UsersMapper();
    		
    		$mapper->findByUsername($this->getRequest()->getPost('uid'),$user);
    		
    		if($user->getId()){
    			$auth = Zend_Auth::getInstance();
    			$values['username'] = $user->getUsername();
    			$values['pwd'] = $this->getRequest()->getPost('pwd');
    			if($this->_process($values)){
    				$data = array('userid'=>$user->getGuid(),'name'=>$user->getName(),'role'=>$user->getRguid());
    				$auth->getStorage()->write($data);
    				$this->_helper->redirector->gotoUrl('/');
    			}
    		} else {
    			$this->view->messages = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">No Access!</h4>You do not have access to this resource.</div>';
    			$form->removeDecorator('htmlTag');
    			$this->view->form = $form;
    		}
    	} else {
    		$form->removeDecorator('htmlTag');
    		$this->view->form = $form;
    	}
    	
    }
    
    public function logoutAction()
    {
    	Zend_Auth::getInstance()->clearIdentity();
    	$this->_helper->redirector->gotoUrl('/');
    }

    protected function _process($values)
    {
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    	$authAdapter->setTableName('users')
    	->setIdentityColumn('username')
    	->setCredentialColumn('pwd')
    	->setCredentialTreatment('MD5(CONCAT(?,"whirlwind_tech_zf_crm"))');
    	
    	$authAdapter->setIdentity($values['username']);
    	$authAdapter->setCredential($values['pwd']);
    	
    	$auth = Zend_Auth::getInstance();
    	$result = $auth->authenticate($authAdapter);
    	if($result->isValid()){
    		return true;
    	}
    
    	return false;
    }
}



