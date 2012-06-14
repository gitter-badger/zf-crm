<?php

class CRM_Model_TicketsMapper
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
			$this->setDbTable('CRM_Model_DbTable_Tickets');
		}
		return $this->_dbTable;
	}
	
	public function save(CRM_Model_Tickets &$ticket){
		$data = array(
				'cguid' => $ticket->getCguid(),
				'uguid' => $ticket->getUguid(),
				'desc'	=> $ticket->getDesc(),
				'solution' => $ticket->getSolution(),
				'date_called' => $ticket->getDatecalled(),
				'date_scheduled'  => $ticket->getDatescheduled(),
				'device_code'	=> $ticket->getDevicecode(),
		);
		if(null === ($id = $ticket->getId())){
			$data['guid'] = md5(microtime()+rand());
			$this->getDbTable()->insert($data);
		} else {
			$data['is_open'] = $ticket->getIsopen();
			$this->getDbTable()->update($data, array('guid=?' => $ticket->getGuid()));
		}
	}
	
	public function findByGuid($id)
	{
		$result = $this->getDbTable()->fetchRow(
				$this->getDbTable()->select()
				->where('guid = ?',$id)
		);
		
		if($result == null){
			return;
		}
		$entry = new CRM_Model_Tickets();
		$entry->setId($result->id)
		->setGuid($result->guid)
		->setCguid($result->cguid)
		->setUguid($result->uguid)
		->setDesc($result->desc)
		->setSolution($result->solution)
		->setDatecalled($result->date_called)
		->setDatescheduled($result->date_scheduled)
		->setDevicecode($result->device_code)
		->setIsopen($result->is_open);
		return $entry;
	}
	
	public function closeByGuid($id)
	{
		$result = $this->getDbTable()->fetchRow(
				$this->getDbTable()->select()
				->where('guid = ?',$id)
		);
		$result->is_open = '0';
		if($result->save()){
			return true;
		} else {
			return false;
		}
	}
	
	public function assignByUguid($tid,$id)
	{
		$result = $this->getDbTable()->fetchRow(
				$this->getDbTable()->select()
				->where('guid = ?',$tid)
		);
		$result->uguid = $id;
		if($result->save()){
			return true;
		} else {
			return false;
		}
	}
	
	public function fetchAllByCGuid($id)
	{
		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('cguid = ?',$id)
		);
		$entries = array();
		foreach($resultSet as $row){
			$entry = new CRM_Model_Tickets();
			$entry->setId($row->id)
			->setGuid($row->guid)
			->setCguid($row->cguid)
			->setUguid($row->uguid)
			->setDesc($row->desc)
			->setSolution($row->solution)
			->setDatecalled($row->date_called)
			->setDatescheduled($row->date_scheduled)
			->setDevicecode($row->device_code)
			->setIsopen($row->is_open);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function fetchAllByUGuid($id)
	{
		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('uguid = ?',$id)
				->where('is_open = 1')
		);
		$entries = array();
		foreach($resultSet as $row){
			$entry = new CRM_Model_Tickets();
			$entry->setId($row->id)
			->setGuid($row->guid)
			->setCguid($row->cguid)
			->setUguid($row->uguid)
			->setDesc($row->desc)
			->setSolution($row->solution)
			->setDatecalled($row->date_called)
			->setDatescheduled($row->date_scheduled)
			->setDevicecode($row->device_code)
			->setIsopen($row->is_open);
			$entries[] = $entry;
		}
		return $entries;
	}
	
	public function findByKeyword($kw,$flag=1)
	{
		$search = $this->getDbTable()->select()
		->where('is_open = ?', $flag)
		->Where('`desc` LIKE "%'.$kw.'%" OR solution LIKE "%'.$kw.'%"');
		
		$resultSet = $this->getDbTable()->fetchAll($search);
		
		if(count($resultSet) > 0){
			$entries = array();
			foreach($resultSet as $row){
				$entry = new CRM_Model_Tickets();
				$entry->setId($row->id)
				->setGuid($row->guid)
				->setCguid($row->cguid)
				->setUguid($row->uguid)
				->setDesc($row->desc)
				->setSolution($row->solution)
				->setDatecalled($row->date_called)
				->setDatescheduled($row->date_scheduled)
				->setDevicecode($row->device_code)
				->setIsopen($row->is_open);
				$entries[] = $entry;
			}
			return $entries;
		} else {
			return false;
		}
	}
	
	public function fetchOpen()
	{
		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('is_open = ?',true)
				);
		$entries = array();
		foreach($resultSet as $row){
			$entry = new CRM_Model_Tickets();
			$entry->setId($row->id)
			->setGuid($row->guid)
			->setCguid($row->cguid)
			->setUguid($row->uguid)
			->setDesc($row->desc)
			->setSolution($row->solution)
			->setDatecalled($row->date_called)
			->setDatescheduled($row->date_scheduled)
			->setDevicecode($row->device_code)
			->setIsopen($row->is_open);
			$entries[] = $entry;
		}
		return $entries;
	}


}

