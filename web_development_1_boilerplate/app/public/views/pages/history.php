<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /login?message=Please log in to view your purchase history");
    exit;
}

require_once(__DIR__ . "/../../controllers/UserController.php");

$userController = new UserController();
$userId = $_SESSION['user_id'];
$purchaseHistory = $userController->getPurchaseHistory($userId);

require(__DIR__ . "/../partials/header.php");
require(__DIR__ . "/../partials/history.php");
require(__DIR__ . "/../partials/footer.php");