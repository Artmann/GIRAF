<?php

class Model
{
    public $id;
    public $database;
    public $table_name;
    private $data;
    
    public function __construct($data) 
    {
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
        
        $model = new Model($data);
        $model->id = $id;
        $model->database = $database;
        $model->table_name = $database;
        return $model;
    }
    
    public function Insert()
    {
        
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