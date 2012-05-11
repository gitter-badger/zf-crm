<?php

class CRM_Form_User extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post')->setName('login')->setAction('/users/add')->setOptions(array('class'=>'well'));
        
        $this->addElement('text','username',array(
        	'required'=>true,
        	'placeholder'=>'Username',
        	'filters' => array('StringTrim')
        ));
        
        $this->addElement('password','pwd',array(
        	'required'=>true,
        	'placeholder'=>'Password',
        	'filters' => array('StringTrim')
        ));
        $this->addElement('text','name',array(
        		'required'=>true,
        		'placeholder'=>'John Smith',
        		'filters' => array('StringTrim')
        ));
        $this->addElement('text','email',array(
        		'required'=>true,
        		'placeholder'=>'user@domain.com',
        		'filters' => array('StringTrim')
        ));
        
        $this->addElement('select','rguid',array(
        		'required'	=> true
        ));
        
        
        $this->addElement('submit','submit',array(
        	'ignore' => true,
        	'label' => 'Submit',
        	'class' => "btn",
        ));
        
        $role = $this->getElement('rguid');
        $role->addMultiOption('','Choose a role');
        $bObj = new CRM_Model_RolesMapper();
        $entries = $bObj->fetchAll();
        foreach($entries as $entry){
        	$role->addMultiOption($entry->guid,$entry->rolename);
        }
        
    }


}

