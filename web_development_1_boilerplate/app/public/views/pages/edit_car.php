<?php



require_once(__DIR__ . "/../../controllers/CarController.php");

$carController = new CarController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carName = $_POST['carName'];
    $car = $carController->getCarByName($carName);
    if (!$car) {
        header("Location: /admin_dashboard?message=Car not found");
        exit;
    }
} else {
    header("Location: /admin_dashboard?message=Invalid request method");
    exit;
}

require(__DIR__ . "/../partials/header.php");
require(__DIR__ . "/../partials/edit_car.php");
require(__DIR__ . "/../partials/footer.php");