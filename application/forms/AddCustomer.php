<?php

class CRM_Form_AddCustomer extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post')->setName('addcustomer')->setAction('/customers/add')->setOptions(array('class'=>'well'));
    	
    	$this->addElement('text','fname',array(
    			'required'=>true,
    			'placeholder'=>'First Name',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','lname',array(
    			'required'=>true,
    			'placeholder'=>'Last Name',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','address1',array(
    			'required'=>true,
    			'placeholder'=>'Address 1',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','address2',array(
    			'placeholder'=>'Address 2',
    			'filters' => array('StringTrim')
    	));
    	$this->addElement('text','city',array(
    			'required'=>true,
    			'placeholder'=>'City',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('select','state',array(
    			'required'=>true,
    	));
    	
    	$this->addElement('text','zip',array(
    			'required'=>true,
    			'placeholder'=>'Zip Code (12345)',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','phone',array(
    			'placeholder'=>'Phone i.e. 419-555-1998',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('text','mobile',array(
    			'placeholder'=>'Mobile i.e. 419-555-1999',
    			'filters' => array('StringTrim')
    	));
    	
    	$this->addElement('submit','submit',array(
    			'ignore' => true,
    			'label' => 'Submit',
    			'class' => "btn",
    	));
    	
    	$usStates = array(
    			'AL' => 'Alabama',
    			'AK' => 'Alaska',
    			'AZ' => 'Arizona',
    			'AR' => 'Arkansas',
    			'CA' => 'California',
    			'CO' => 'Colorado',
    			'CT' => 'Connecticut',
    			'DE' => 'Delaware',
    			'FL' => 'Florida',
    			'GA' => 'Georgia',
    			'HI' => 'Hawaii',
    			'ID' => 'Idaho',
    			'IL' => 'Illinois',
    			'IN' => 'Indiana',
    			'IA' => 'Iowa',
    			'KS' => 'Kansas',
    			'KY' => 'Kentucky',
    			'LA' => 'Louisiana',
    			'ME' => 'Maine',
    			'MD' => 'Maryland',
    			'MA' => 'Massachusetts',
    			'MI' => 'Michigan',
    			'MN' => 'Minnesota',
    			'MS' => 'Mississippi',
    			'MO' => 'Missouri',
    			'MT' => 'Montana',
    			'NE' => 'Nebraska',
    			'NV' => 'Nevada',
    			'NH' => 'New Hampshire',
    			'NJ' => 'New Jersey',
    			'NM' => 'New Mexico',
    			'NY' => 'New York',
    			'NC' => 'North Carolina',
    			'ND' => 'North Dakota',
    			'OH' => 'Ohio',
    			'OK' => 'Oklahoma',
    			'OR' => 'Oregon',
    			'PA' => 'Pennsylvania',
    			'RI' => 'Rhode Island',
    			'SC' => 'South Carolina',
    			'SD' => 'South Dakota',
    			'TN' => 'Tennessee',
    			'TX' => 'Texas',
    			'UT' => 'Utah',
    			'VT' => 'Vermont',
    			'VA' => 'Virginia',
    			'WA' => 'Washington',
    			'WV' => 'West Virginia',
    			'WI' => 'Wisconsin',
    			'WY' => 'Wyoming',
    	);
    	
    	$states = $this->getElement("state");
    	foreach($usStates as $key=>$value){
    		$states->addMultiOption($key,$value);
    	}
    	
    	$states->setValue('OH');
    }


}

