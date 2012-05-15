<?php

class CRM_Form_AddTicket extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post')->setName('addticket')->setOptions(array('class'=>'well'));
    	
    	$this->addElement('textarea','desc',array(
    			'required'=>true,
    			'placeholder'=>'Description of problem',
    			'rows' => 10,
    			'class' => 'span5',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','datecalled',array(
    			'required'=>true,
    			'placeholder'=>'Date Called',
    			'class'=>'input-medium datePicker',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','datescheduled',array(
    			'placeholder'=>'Date Scheduled',
    			'class'=>'input-medium datePicker',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('select','uguid',array(
    	));
//     	$this->addElement('text','device',array(
//     			'placeholder'=>'Device Barcode',
//     			'filters' => array('StringTrim')
//     	));

    	$this->addElement('submit','submit',array(
    			'ignore' => true,
    			'label' => 'Submit',
    			'class' => "btn",
    	));
    	
    	$user = $this->getElement('uguid');
    	$user->addMultiOption('','Assign a User');
    	$bObj = new CRM_Model_UsersMapper();
    	$entries = $bObj->fetchAll();
    	foreach($entries as $entry){
    		$user->addMultiOption($entry->guid,$entry->name);
    	}
    }


}

