<?php

class CarModel extends Model
{
    public static $database = "localhost";
    public static $table_name = "car";
    
    public $id;
    public $brand;
    public $model;
    public $year;

}
