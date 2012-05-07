<?php

class CRM_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post')->setName('login')->setAction('/login');
        
        $this->addElement('text','uid',array(
        	'required'=>true,
        	'placeholder'=>'Username',
        	'filters' => array('StringTrim')
        ));
        
        $this->addElement('password','pwd',array(
        	'required'=>true,
        	'placeholder'=>'Password',
        	'filters' => array('StringTrim')
        ));
        
        $this->addElement('submit','submit',array(
        	'ignore' => true,
        	'label' => 'Submit',
        	'class' => "btn",
        ));
    }


}

