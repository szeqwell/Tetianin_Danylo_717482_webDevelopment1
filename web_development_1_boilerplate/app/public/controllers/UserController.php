<?php

require_once(__DIR__ . "/../models/UserModel.php");

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getAll()
    {
        return $this->userModel->getAll();
    }

    public function get($id)
    {
        return $this->userModel->get($id);
    }

    public function create($email, $username, $password, $role = 'user')
    {
        $this->userModel->create($email, $username, $password, $role);
    }

    public function getByEmail($email)
    {
        return $this->userModel->getByEmail($email);
    }

    public function getPurchaseHistory($userId)
    {
        return $this->userModel->getPurchaseHistory($userId);
    }

    public function addCarToUser($userId, $carId)
    {
        $this->userModel->addCarToUser($userId, $carId);
    }
}