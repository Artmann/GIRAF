<?php

class Model
{
    public $id;
    public $table_name;
    
    public function __construct($data) 
    {
        foreach($data as $key => $value)
            $this->$key = $value;
    }
    
    public static function Load($id, $database, $table_name)
    {
        $sql = "SELECT * FROM :table WHERE id=:id";
        $data = array(":id" => (int)$id, ":table" => table_name);
        
        $res = Database::Query($sql, $data, $database);
        
        $data = array();
        
        while ($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            foreach($row as $key => $value)
                $data[$key] = $value;
        }
        
        return new Model($data);
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