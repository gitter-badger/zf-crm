<?php

class CRM_Model_Roles
{

	protected $_id;
	protected $_guid;
	protected $_role_name;
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
	
	public function setRolename($r)
	{
		$this->_role_name = (string) $r;
		return $this;
	}
	
	public function getRolename()
	{
		return $this->_role_name;
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

