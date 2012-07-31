<?php

class Model
{
    public $id;
    public static $database;
    public static $table_name;
    private $data;
    
    public function __construct($data) 
    {
        $this->data = $data;
    }
    
    public static function Load($id)
    {
        $sql = "SELECT * FROM ".static::$table_name." WHERE id=:id";
        $data = array(":id" => (int)$id);
        
        $res = Database::Query($sql, $data, static::$database);
        
        $data = array();
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row)
            foreach($row as $key => $value)
             $data[$key] = $value;
        
        $class = get_called_class();
        $model = new $class($data);
        $model->id = $id;
        return $model;
    }
    
    public static function LoadAll()
    {
        $models = array();

        $res = Database::Query("SELECT id FROM ".static::$table_name."", array(), static::$database);
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as $row)
        {
                $models[] = static::Load($row["id"]);

        }

        return $models;
    }
    
    public function Insert()
    {
        if(sizeof($this->data) < 1)
            throw new Exception("No data to insert.");
        
        $keys = array_keys($this->data);
        $pdokeys = ":".implode(",:", $keys);
        $sql = "INSERT INTO ".  static::$table_name."(".  implode(", ", $keys).") VALUES($pdokeys)";
        $data = array_combine(explode(',',$pdokeys), array_values($this->data));
        print_r($data);
        Database::Query($sql, $data, static::$database);
        
    }
    
    public function Update()
    {
        $pairs = array();
        $binds = array();
        
        foreach ($this->data as $key => $value)
        {
            $pairs[] = "$key=:$key";
            $binds[":$key"] = $value;
        }
        
        $sql = "UPDATE ".static::$table_name." SET ".implode(",", $pairs)." WHERE id=".$this->id;
        Database::Query($sql, $binds,  static::$database);
        
    }
    
    public function Delete()
    {
        
    }
    
    public function data()
    {
        return $this->data;
    }
    
    public function Get($key)
    {
        if(!isset($this->data[$key]))
            throw new Exception("Could not find property $key in ".  get_class($this));
        
        return $this->data[$key];
    }
    public function Set($key, $value)
    {
        $this->data[$key] = $value;
    }
    
}