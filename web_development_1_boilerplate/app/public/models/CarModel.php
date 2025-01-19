<?php

require_once(__DIR__ . "/BaseModel.php");

class CarModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCars()
    {
        $sql = "SELECT * FROM car WHERE active = 1";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCarByName($name)
    {
        $sql = "SELECT * FROM car WHERE name = :name AND active = 1";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addCar($name, $price, $imagePath)
    {
        $sql = "INSERT INTO car (name, price, image_path, active) VALUES (:name, :price, :image_path, 1)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":image_path", $imagePath);
        $stmt->execute();
    }
    public function updateCar($id, $name, $price, $imagePath)
    {
        $sql = "UPDATE car SET name = :name, price = :price, image_path = :image_path WHERE Id = :id AND active = 1";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":image_path", $imagePath);
        $stmt->execute();
    }

    public function getCarById($id)
    {
        $sql = "SELECT * FROM car WHERE Id = :id AND active = 1";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function deleteCarById($id)
    {
        $sql = "UPDATE car SET active = 0 WHERE Id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}