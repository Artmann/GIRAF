<?php

class Model
{
    public $id;
    public static $database;
    public static $table_name;
    
    public function __construct($data) 
    {
       foreach($data as $key => $value)
           $this->$key = $value;
    }
    
    public static function Load($id)
    {
        $sql = "SELECT * FROM ".static::$table_name." WHERE id=:id";
        $data = array(":id" => (int)$id);
        
        $res = Database::Query($sql, $data, static::$database);
        
        $modelData = array();
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row)
            foreach($row as $key => $value)
             $modelData[$key] = $value;
        
        $class = get_called_class();
        $model = new $class($modelData);
        
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
        $data = $this->getData();
       
        if(sizeof($data) < 1)
            throw new Exception("No data to insert.");
        
        $keys = array_keys($data);
        $pdokeys = ":".implode(",:", $keys);
        $sql = "INSERT INTO ".  static::$table_name."(".  implode(", ", $keys).") VALUES($pdokeys)";
        $data = array_combine(explode(',',$pdokeys), array_values($data));
        echo "$sql<br>";
        Database::Query($sql, $data, static::$database);
        
    }
    
    public function Update()
    {
        $pairs = array();
        $binds = array();
        $data = $this->getData();
        
        if(!isset($data["id"]) or $data["id"] < 0)
            throw new Exception("Update: Invalid id.");
        
        foreach ($data as $key => $value)
        {
            $pairs[] = "$key=:$key";
            $binds[":$key"] = $value;
        }
        
        $sql = "UPDATE ".static::$table_name." SET ".implode(",", $pairs)." WHERE id=".$this->id;
        Database::Query($sql, $binds,  static::$database);
        
    }
    
    public function Delete()
    {
        $data = array(":id" => (int) $this->id);
        $sql = "DELETE FROM ".static::$table_name." WHERE id = :id";
        
        $res = Database::Query($sql, $data, static::$database);
        
        if(!$res)
            throw new Exception("Could not delete record.");
    }
    
    private function getData()
    {
        $class = get_called_class();
        $reflect = new ReflectionClass($class);
        $props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        
        $data = array();
        
        foreach($props as $prop)
        {
            $v = $prop->getName();
            if(!$prop->isStatic() && isset($this->$v))
                $data[$v] = $this->$v;
        }
        
        return $data;
    }
    
    
}