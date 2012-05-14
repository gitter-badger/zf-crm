<?php

class CRM_Form_Search extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post')->setName('search')->setAction('/index/results')->setOptions(array('class'=>'form-search'));
    	
    	$this->addElement('text','keyword',array(
    			'required'=>true,
    			'placeholder'=>'Keyword',
    			'class'	=>'span6 input-xlarge search-query',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('submit','submit',array(
    			'ignore' => true,
    			'label' => 'Submit',
    			'class' => "btn",
    	));
    }


}

