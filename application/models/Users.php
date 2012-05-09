<?php

class CRM_Model_Users
{

	protected $_id;
	protected $_guid;
	protected $_rguid;
	protected $_username;
	protected $_pwd;
	protected $_name;
	protected $_email;
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
	
	public function setRguid($rguid)
	{
		$this->_rguid = (string) $rguid;
		return $this;
	}
	
	public function getRguid()
	{
		return $this->_rguid;
	}
	
	public function setUsername($name)
	{
		$this->_username = (string) $name;
		return $this;
	}
	
	public function getUsername()
	{
		return $this->_username;
	}
	
	public function setPwd($r)
	{
		$this->_pwd = (string) $r;
		return $this;
	}
	
	public function getPwd()
	{
		return $this->_pwd;
	}
	
	public function setName($fullName)
	{
		$this->_name = (string) $fullName;
		return $this;
	}
	
	public function getName()
	{
		return $this->_name;
	}
	
	public function setEmail($r)
	{
		$this->_email = (string) $r;
		return $this;
	}
	
	public function getEmail()
	{
		return $this->_email;
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

