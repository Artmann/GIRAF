<?php

class CarController extends Controller
{
    public function details($data)
    {
         $car = new CarModel($data["id"]);
         $data = array("car" => $car);
         
         return $this->createResponse($data);
    }
    
    public function test($data)
    {
        $car = CarModel::Load(5);
        $car->model = "foobar";
        $car->Update();
        
        
        
        return $this->createResponse($car);
    }
}