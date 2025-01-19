<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Access denied']);
    exit;
}

require_once(__DIR__ . "/../../controllers/CarController.php");

$carController = new CarController();

$name = $_POST['name'];
$price = $_POST['price'];
$image = $_FILES['image'];

// Handle file upload
$targetDir = __DIR__ . "/../img/";
$targetFile = $targetDir . basename($image["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($image["tmp_name"]);
if ($check === false) {
    echo json_encode(['status' => 'error', 'message' => 'File is not an image.']);
    exit;
}

// Check file size (5MB limit)
if ($image["size"] > 5000000) {
    echo json_encode(['status' => 'error', 'message' => 'Sorry, your file is too large.']);
    exit;
}

// Allow certain file formats
$allowedFormats = ["jpg", "jpeg", "png", "gif", "webp"];
if (!in_array($imageFileType, $allowedFormats)) {
    echo json_encode(['status' => 'error', 'message' => 'Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.']);
    exit;
}

// Try to upload file
if (!move_uploaded_file($image["tmp_name"], $targetFile)) {
    echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
    exit;
}

// Store the file path in the database
$imagePath = basename($image["name"]);

try {
    $carController->addCar($name, $price, $imagePath);
    echo json_encode(['status' => 'success', 'car' => ['name' => $name, 'price' => $price, 'image_path' => $imagePath]]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>