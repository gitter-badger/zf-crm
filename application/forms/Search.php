<?php

class CRM_Form_Search extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post')->setName('login')->setAction('/index/results');
    	
    	$this->addElement('text','keyword',array(
    			'required'=>true,
    			'placeholder'=>'Keyword',
    			'class'	=>'span6',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('submit','submit',array(
    			'ignore' => true,
    			'label' => 'Submit',
    			'class' => "btn",
    	));
    }


}

