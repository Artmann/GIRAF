<?php

class CarController extends Controller
{
    public function details($data)
    {
        var_dump($data);
         $car = new CarModel($data["id"]);
         
         $data = array("car" => $car);
         
         return $this->createResponse($data);
    }
}