<?php

class CRM_Form_EditCustomer extends CRM_Form_AddCustomer
{

    public function init()
    {
        parent::init();
		$this->setAction('/customers/edit');
		
		$this->addElement('hidden','guid');
    }


}

