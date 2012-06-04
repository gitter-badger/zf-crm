<?php

class CRM_Form_AddTicket extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post')->setName('addticket')->setOptions(array('class'=>'well'));
    	
    	$this->addElement('textarea','desc',array(
    			'required'=>true,
    			'label'=>'Description',
    			'placeholder'=>'Description of problem',
    			'rows' => 10,
    			'class' => 'span5',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','datecalled',array(
    			'required'=>true,
    			'label' => 'Date Called',
    			'placeholder'=>'Date Called',
    			'class'=>'input-medium datePicker',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','datescheduled',array(
    			'label' =>'Date Scheduled',
    			'placeholder'=>'Date Scheduled',
    			'class'=>'input-medium datePicker',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('select','uguid',array(
    			'label'=>'Assign To',
    	));
//     	$this->addElement('text','device',array(
//     			'placeholder'=>'Device Barcode',
//     			'filters' => array('StringTrim')
//     	));

    	$this->addElement('textarea','solution',array(
    			'required'=>false,
    			'label'=>'Solution',
    			'placeholder'=>'Solution',
    			'rows' => 10,
    			'class' => 'span5',
    			'filters' => array('StringTrim')
    	));

    	$this->addElement('submit','Submit',array(
    			'ignore' => true,
    			'value' => 'Submit',
    			'class' => "btn",
    	));
    	
    	$user = $this->getElement('uguid');
    	$user->addMultiOption('','Assign a User');
    	$bObj = new CRM_Model_UsersMapper();
    	$entries = $bObj->fetchAll();
    	foreach($entries as $entry){
    		$user->addMultiOption($entry->guid,$entry->name);
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

