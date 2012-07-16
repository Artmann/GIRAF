<?php

class Model
{
    public $id;
    public $database;
    public $table_name;
    private $data;
    
    public function __construct($data, $database, $table_name) 
    {
        $this->database = $database;
        $this->table_name = $table_name;
        $this->data = $data;
    }
    
    public static function Load($id, $database, $table_name)
    {
        $sql = "SELECT * FROM :table WHERE id=:id";
        $data = array(":id" => (int)$id, ":table" => $table_name);
        
        $res = Database::Query($sql, $data, $database);
        
        $data = array();
        
        while ($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            foreach($row as $key => $value)
                $data[$key] = $value;
        }
        
        $model = new Model($data, $database, $table_name);
        $model->id = $id;
        return $model;
    }
    
    public function Insert()
    {
        if(sizeof($this->data) < 1)
            throw new Exception("No data to insert.");
        
        $keys = array_keys($this->data);
        $pdokeys = ":".implode(",:", $keys);
        $sql = "INSERT INTO ".$this->table_name."(".  implode(", ", $keys).") VALUES($pdokeys)";
        $data = array_combine(explode(',',$pdokeys), array_values($this->data));
        print_r($data);
        Database::Query($sql, $data, $this->database);
        
    }
    
    public function Update()
    {
        
    }
    
    public function Delete()
    {
        
    }
    
    public function __get($key)
    {
        return isset($this->holder[$key]) ? $this->holder[$key] : false;
    }
    public function __set($key, $value)
    {
        $this->holder[$key] = $value;
    }
    
}