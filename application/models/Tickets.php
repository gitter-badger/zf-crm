<?php

class CRM_Model_Tickets
{
	protected $_id; 	
	protected $_guid;
	protected $_cguid;
	protected $_uguid;
	protected $_desc;
	protected $_solution;
	protected $_date_called;
	protected $_date_scheduled;
	protected $_device_code;
	protected $_is_open;

	public function __construct(array $options = null)
	{
		if(is_array($options)){
			$this->setOptions($options);
		}
	}
	
	public function __set($name,$value)
	{
		$method = 'set'.$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Invalid user property');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' .$name;
		if(('mapper' == $name) || !method_exists($this, $method)){
			throw new Exception('Invalid user property');
		}
		return $this->$method();
	}
	
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach($options as $key => $value){
			$method = 'set'.ucfirst($key);
			if(in_array($method,$methods)){
				$this->$method($value);
			}
		}
		return $this;
	}
	
	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setGuid($guid)
	{
		$this->_guid = (string) $guid;
		return $this;
	}
	
	public function getGuid()
	{
		return $this->_guid;
	}
	
	public function setCguid($c)
	{
		$this->_cguid = (string) $c;
		return $this;
	}
	
	public function getCguid()
	{
		return $this->_cguid;
	}
	
	public function setUguid($u)
	{
		$this->_uguid = (string) $u;
		return $this;
	}
	
	public function getUguid()
	{
		return $this->_uguid;
	}
	
	public function setDesc($text)
	{
		$this->_desc = (string) $text;
		return $this;
	}
	
	public function getDesc()
	{
		return $this->_desc;
	}
	
	public function setSolution($text)
	{
		$this->_solution = (string) $text;
		return $this;
	}
	
	public function getSolution()
	{
		return $this->_solution;
	}
	
	public function setDatecalled($date)
	{
		$this->_date_called = $this->_formatDate($date);
		return $this;
	}
	
	public function getDatecalled()
	{
		return $this->_date_called;
	}
	
	public function setDatescheduled($date)
	{
		$this->_date_scheduled = $this->_formatDate($date);
		return $this;
	}
	
	public function getDatescheduled()
	{
		return $this->_date_scheduled;
	}

	public function setDevicecode($code)
	{
		$this->_device_code = $code;
		return $this;
	}
	
	public function getDevicecode()
	{
		return $this->_device_code;
	}
	
	public function setIsopen($open)
	{
		$this->_is_open = (int) $open;
		return $this;
	}
	
	public function getIsopen()
	{
		return $this->_is_open;
	}
	
	protected function _formatDate($string)
	{
		$arrDate = explode("/", $string);
		if(count($arrDate) > 1){
			$str = $arrDate[2] ."-".$arrDate[0]."-".$arrDate[1];
		} else {
			$str = $string;
		}
		return $str;
	}
}

