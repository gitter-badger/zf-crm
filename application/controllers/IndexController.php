<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new CRM_Form_Login();
        $this->view->form = $form;
    }

    public function loginAction()
    {
    	$form = new CRM_Form_Login();
    	if($this->getRequest()->getPost()){
    		$arrValues = $this->getRequest()->getPost();
    	} else {
    		$this->view->form = $form;
    	}
    }

}

