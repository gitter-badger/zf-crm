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
	
	public function save(CRM_Model_Users &$user){
		$data = array(
				'username' => $user->getUsername(),
				'name' => $user->getName(),
				'email'	=> $user->getEmail(),
				'pwd' => md5($user->getPwd()."whirlwind_tech_zf_crm"),
				'rguid'  => $user->getRguid(),
		);
		if(null === ($id = $user->getId())){
			$data['guid'] = md5(microtime()+rand());
			$this->getDbTable()->insert($data);
		} else {
			$data['is_active'] = $user->getIsactive();
			$this->getDbTable()->update($data, array('guid=?' => $user->getGuid()));
		}
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
	
	public function findByGuid($id, CRM_Model_Users &$user)
	{
		$result = $this->getDbTable()->fetchRow(
				$this->getDbTable()->select()
				->where('guid = ?',$id)
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
	
	public function delete($id)
	{
		$where = $this->getDbTable()->getAdapter()->quoteInto('guid = ?', $id);
		if($this->getDbTable()->delete($where)){
			return true;
		}
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new CRM_Model_Users();
			$entry->setId($row->id)
			->setGuid($row->guid)
			->setRguid($row->rguid)
			->setUsername($row->username)
			->setPwd($row->pwd)
			->setName($row->name)
			->setEmail($row->email)
			->setIsactive($row->is_active);
			$entries[] = $entry;
		}
		return $entries;
	}

}

