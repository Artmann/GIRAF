<?php


class APIKey
{
	private $id;
	private $name;
	private $key;
	
	public function __construct($id, $name, $key)
	{
		$this->id = $id;
		$this->name = $name;
		$this->key = $key;
	}
	
	public static function Create($name, $key)
	{
		//Insert into Database
	}
	
	public static function Load($id)
	{
	}
        
        public static function GetGroup($key)
        {
            
        }
}
