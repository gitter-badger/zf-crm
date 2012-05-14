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
    	
    	$this->addElement('text','date_called',array(
    			'required'=>true,
    			'placeholder'=>'Date Called',
    			'class'=>'input-medium datePicker',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','date_scheduled',array(
    			'placeholder'=>'Date Scheduled',
    			'class'=>'input-medium datePicker',
    			'filters' => array('StringTrim')
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
    }


}

