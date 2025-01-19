<?php

require_once(__DIR__ . "/../models/CarModel.php");

class CarController
{
    private $carModel;

    public function __construct()
    {
        $this->carModel = new CarModel();
    }

    public function getAllCars()
    {
        return $this->carModel->getAllCars();
    }

    public function getCarByName($name)
    {
        return $this->carModel->getCarByName($name);
    }

    public function getCarById($id)
    {
        return $this->carModel->getCarById($id);
    }

    public function addCar($name, $price, $imagePath)
    {
        $this->carModel->addCar($name, $price, $imagePath);
    }

    public function updateCar($id, $name, $price, $imagePath)
    {
        $this->carModel->updateCar($id, $name, $price, $imagePath);
    }

    public function deleteCarById($id)
    {
        $this->carModel->deleteCarById($id);
    }
}