
<?php

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: /views/pages/login.php?message=Access denied");
    exit;
}

require(__DIR__ . "/../partials/header.php");

require_once(__DIR__ . "/../../controllers/CarController.php");
$carController = new CarController();
$cars = $carController->getAllCars();

require(__DIR__ . "/../partials/admin_dashboard.php");

require(__DIR__ . "/../partials/footer.php");
?>

