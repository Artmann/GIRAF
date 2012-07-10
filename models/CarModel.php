<?php

class CarModel
{
    public $id;
    public $brand;
    public $model;
    public $year;
    
    public function __construct($id) 
    {
        $res = Database::Query("SELECT * FROM car WHERE id=:id", array("id" => $id), "localhost");
        $row = $res->fetch(PDO::FETCH_ASSOC);
        
        $this->id = $id;
        $this->brand = $row["brand"];
        $this->model = $row["model"];
        $this->year = $row["year"];
    }
    
}


?>
