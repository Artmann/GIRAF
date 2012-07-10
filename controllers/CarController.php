<?php

class CarController extends Controller
{
    public function getYear()
    {
         $car = new CarModel();
         
         $data = array("year" => $car->getYear());
         
         return $this->createResponse($data);
    }
}