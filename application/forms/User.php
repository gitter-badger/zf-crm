<?php

class CRM_Form_User extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post')->setName('users')->setAction('/users/add')->setOptions(array('class'=>'well'));
        
        $this->addElement('text','username',array(
        	'label'=>'Username',
        	'required'=>true,
        	'placeholder'=>'Username',
        	'filters' => array('StringTrim')
        ));
        
        $this->addElement('password','pwd',array(
        	'label'=>'Password',
        	'required'=>true,
        	'placeholder'=>'Password',
        	'filters' => array('StringTrim')
        ));
        $this->addElement('text','name',array(
        		'label'=>'Full Name',
        		'required'=>true,
        		'placeholder'=>'John Smith',
        		'filters' => array('StringTrim')
        ));
        $this->addElement('text','email',array(
        		'label'=>'Email',
        		'required'=>true,
        		'placeholder'=>'user@domain.com',
        		'filters' => array('StringTrim')
        ));
        
        $this->addElement('select','rguid',array(
        		'label' => 'Role',
        		'required'	=> true
        ));
        
        
        $this->addElement('submit','Submit',array(
        	'ignore' => true,
        	'value' => 'Submit',
        	'class' => "btn",
        ));
        
        $role = $this->getElement('rguid');
        $role->addMultiOption('','Choose a role');
        $bObj = new CRM_Model_RolesMapper();
        $entries = $bObj->fetchAll();
        foreach($entries as $entry){
        	$role->addMultiOption($entry->guid,$entry->rolename);
        }
        
        $arrElements = $this->getElements();
        //var_dump($arrElements);
        foreach($arrElements as $element){
        	if($element->helper != 'formSubmit'){
        		$element->setDecorators(array('ViewHelper','Label'));
        	} else {
        		$element->setDecorators(array('ViewHelper'));
        	}
        }
        
    }


}

