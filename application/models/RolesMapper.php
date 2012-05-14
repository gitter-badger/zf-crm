<?php

class CRM_Model_RolesMapper
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
			$this->setDbTable('CRM_Model_DbTable_Roles');
		}
		return $this->_dbTable;
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new CRM_Model_Roles();
			$entry->setId($row->id)
			->setGuid($row->guid)
			->setRolename($row->role_name)
			->setIsactive($row->is_active);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function fetchArray()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach($resultSet as $row){
			$entries[$row->guid] = $row->role_name;
		}
		return $entries;
	}

}

