<?php

class CRM_Form_EditTicket extends CRM_Form_AddTicket
{

    public function init()
    {
        parent::init();
		$this->setAction('/tickets/edit');
		
		$this->addElement('hidden','guid');
    }


}

