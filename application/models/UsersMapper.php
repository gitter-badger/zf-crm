<?php

class CRM_Model_UsersMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if(is_string($dbTable)){
			$dbTable = new $dbTable();
		}
		if(!$dbTable instanceof Zend_Db_Table_Abstract){
			throw new Exception('Invalid table data gateway provided');
		}
	
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if(null === $this->_dbTable){
			$this->setDbTable('CRM_Model_DbTable_Users');
		}
		return $this->_dbTable;
	}
	

	public function findByUsername($id, CRM_Model_Users &$user)
	{
		$result = $this->getDbTable()->fetchRow(
				$this->getDbTable()->select()
				->where('username = ?',$id)
		);
		if($result == null){
			return;
		}
		//$row = $result->current();
		$user->setId($result->id)
		->setGuid($result->guid)
		->setRguid($result->rguid)
		->setUsername($result->username)
		->setPwd($result->pwd)
		->setName($result->name)
		->setEmail($result->email)
		->setIsactive($result->is_active);
	}

}

