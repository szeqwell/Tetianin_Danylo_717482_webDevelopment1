<?php

require_once(__DIR__ . "/BaseModel.php");

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($email, $username, $password, $role = 'user')
    {
        $sql = "INSERT INTO user_demo_1 (email, username, password, role) VALUES (:email, :username, :password, :role)";

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":role", $role);

        $stmt->execute();
    }

    public function getAll()
    {
        $sql = "SELECT Id, email, username, role FROM user_demo_1";
        $stmt = self::$pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id)
    {
        $sql = "SELECT Id, email, username, role FROM user_demo_1 WHERE Id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getByEmail($email)
    {
        $sql = "SELECT Id, email, username, password, role FROM user_demo_1 WHERE email = :email";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getPurchaseHistory($userId)
    {
        $sql = "SELECT car.name, car.price, car.image_path, user_cars.purchase_date 
                FROM user_cars 
                JOIN car ON user_cars.car_id = car.id 
                WHERE user_cars.user_id = :user_id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addCarToUser($userId, $carId)
    {
        $sql = "INSERT INTO user_cars (user_id, car_id) VALUES (:user_id, :car_id)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":car_id", $carId);
        $stmt->execute();
    }
}