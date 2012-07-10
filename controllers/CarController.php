<?php

class CarController 
{
    public function getYear()
    {
         $car = new CarModel();
         return $car->getYear();
    }
}