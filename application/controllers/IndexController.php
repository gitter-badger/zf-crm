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
    		$this->view->headScript()->appendScript("$('.dropdown-toggle').dropdown();");
    		$search = new CRM_Form_Search();
    		$this->view->search = $search;
    	} else {
    		// Non-Authenticated User
        	$form = new CRM_Form_Login();
        	$this->view->form = $form;
    	}
    }
    
    public function resultsAction()
    {
    	$search = new CRM_Form_Search();
    	if($this->getRequest()->getPost('keyword')){
    		$arrValues = $this->getRequest()->getPost();
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
    			$this->view->form = $form;
    		}
    	} else {
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



