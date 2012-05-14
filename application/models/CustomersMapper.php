<?php

class CRM_Model_CustomersMapper
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
			$this->setDbTable('CRM_Model_DbTable_Customers');
		}
		return $this->_dbTable;
	}
	
	public function save(CRM_Model_Customers &$c){
		
		$data = array(
				'f_name' => $c->getFname(),
				'l_name' => $c->getLname(),
				'address_1'	=> $c->getAddress1(),
				'address_2' => $c->getAddress2(),
				'city'  => $c->getCity(),
				'state' => $c->getState(),
				'zip'	=> $c->getZip(),
				'phone' => $c->getPhone(),
				'mobile'=> $c->getMobile(),
		);
		if(null === ($id = $c->getId())){
			$data['guid'] = md5(microtime()+rand());
			$this->getDbTable()->insert($data);
		} else {
			$data['is_active'] = $c->getIsactive();
			$this->getDbTable()->update($data, array('guid=?' => $c->getGuid()));
		}
	}
	
	public function findByKeyword($kw)
	{
		$search = $this->getDbTable()->select()
				->where('f_name LIKE ?',"%".$kw."%")
				->orWhere('l_name LIKE ?',"%".$kw."%")
				->orWhere('address_1 LIKE ?',"%".$kw."%")
				->orWhere('address_2 LIKE ?',"%".$kw."%")
				->orWhere('city LIKE ?',"%".$kw."%")
				->orWhere('state LIKE ?',"%".$kw."%")
				->orWhere('zip LIKE ?',"%".$kw."%")
				->orWhere('phone LIKE ?',"%".$kw."%")
				->orWhere('mobile LIKE ?',"%".$kw."%");
		
		$resultSet = $this->getDbTable()->fetchAll($search);
		
		
		if(count($resultSet) > 0){
			$entries = array();
			foreach($resultSet as $row){
				$entry = new CRM_Model_Customers();
				$entry->setId($row->id)
				->setGuid($row->guid)
				->setFname($row->f_name)
				->setLname($row->l_name)
				->setAddress1($row->address_1)
				->setAddress2($row->address_2)
				->setCity($row->city)
				->setState($row->state)
				->setZip($row->zip)
				->setPhone($row->phone)
				->setMobile($row->mobile)
				->setIsactive($row->is_active);
				$entries[] = $entry;
			}
			return $entries;
		} else {
			return false;
		}
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$entries = array();
		foreach($resultSet as $row){
			$entry = new CRM_Model_Customers();
			$entry->setId($row->id)
				  ->setGuid($row->guid)
				  ->setFname($row->f_name)
				  ->setLname($row->l_name)
				  ->setAddress1($row->address_1)
				  ->setAddress2($row->address_2)
				  ->setCity($row->city)
				  ->setState($row->state)
				  ->setZip($row->zip)
				  ->setPhone($row->phone)
				  ->setMobile($row->mobile)
				  ->setIsactive($row->is_active);
			$entries[] = $entry;
		}
		return $entries;
	}

}

