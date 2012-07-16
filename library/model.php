<?php

class Model
{
    public $id;
    public $dbname;
    
    public function __construct($data) 
    {
        foreach($data as $key => $value)
            $this->$key = $value;
    }
    
    public static function Load($id)
    {
        
    }
    
    public static function Create($data)
    {
        
    }
    
    public function Update()
    {
        
    }
    
    public function Delete()
    {
        
    }
    
}