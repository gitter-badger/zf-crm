<?php

class CRM_Form_UserEdit extends CRM_Form_User
{

    public function init()
    {
        parent::init();
		$this->setAction('/users/edit');
		
		$this->addElement('hidden','guid');
		$pwd = $this->getElement('pwd');
		$pwd->setAttrib("placeholder", "Change Password");
    }


}

