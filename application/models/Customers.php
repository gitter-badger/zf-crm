<?php

class CRM_Model_Customers
{
	protected $_id;
	protected $_guid;
	protected $_f_name;
	protected $_l_name;
	protected $_address_1;
	protected $_address_2;
	protected $_city;
	protected $_state;
	protected $_zip;
	protected $_phone;
	protected $_mobile;
	protected $_is_active;
	
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
	
	public function setFname($name)
	{
		$this->_f_name = (string) $name;
		return $this;
	}
	
	public function getFname()
	{
		return $this->_f_name;
	}
	
	public function setLname($name)
	{
		$this->_l_name = (string) $name;
		return $this;
	}
	
	public function getLname()
	{
		return $this->_l_name;
	}
	
	public function setAddress1($address)
	{
		$this->_address_1 = (string) $address;
		return $this;
	}
	
	public function getAddress1()
	{
		return $this->_address_1;
	}
	
	public function setAddress2($address)
	{
		$this->_address_2 = (string) $address;
		return $this;
	}
	
	public function getAddress2()
	{
		return $this->_address_2;
	}
	
	public function setCity($city)
	{
		$this->_city = (string) $city;
		return $this;
	}
	
	public function getCity()
	{
		return $this->_city;
	}
	
	public function setState($oh)
	{
		$this->_state = (string) $oh;
		return $this;
	}
	
	public function getState()
	{
		return $this->_state;
	}
	
	public function setZip($zip)
	{
		$this->_zip = $zip;
		return $this;
	}
	
	public function getZip()
	{
		return $this->_zip;
	}
	
	public function setPhone($z)
	{
		$this->_phone = $z;
		return $this;
	}
	
	public function getPhone()
	{
		return $this->_phone;
	}
	
	public function setMobile($z)
	{
		$this->_mobile = $z;
		return $this;
	}
	
	public function getMobile()
	{
		return $this->_mobile;
	}

	public function setIsactive($i)
	{
		$this->_is_active = (int) $i;
		return $this;
	}
	
	public function getIsactive()
	{
		return $this->_is_active;
	}
}

