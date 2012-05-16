<?php

class CRM_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post')->setName('login')->setAction('/index/login')->setOptions(array('class'=>'well'));
        
        $this->addElement('text','uid',array(
        	'required'=>true,
        	'placeholder'=>'Username',
        	'label'=> 'Username',
        	'filters' => array('StringTrim')
        ));
        
        $this->addElement('password','pwd',array(
        	'required'=>true,
        	'placeholder'=>'Password',
        	'label'=> 'Password',
        	'filters' => array('StringTrim')
        ));
        
        $this->addElement('submit','Submit',array(
        	'ignore' => true,
        	'value' => 'Submit',
        	'class' => "btn",
        ));
        
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

