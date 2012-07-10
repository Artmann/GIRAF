<?php

class Database
{
    public static function Query($sql, $data, $database)
    {
        require_once 'db.config.php';
        
        $dbconf = $databases[$database];
        
        $connection = new PDO("mysql:host=".$dbconf['host']."dbname=".$dbconf['database'], $dbconf['username'], $dbconf['password']);
            
        $res = $connection->query($sql); 
        
        if(!$res)
            throw  new Exception($connection->errorInfo());
        
        return $res;
    }
    
}