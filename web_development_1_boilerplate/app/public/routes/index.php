<?php

Route::add('/', function () {
    require(__DIR__ . "/../views/pages/index.php");
});


Route::add('/login', function () {
    require(__DIR__ . "/../views/pages/login.php");
});

Route::add('/register', function () {
    require(__DIR__ . "/../views/pages/register.php");
});


Route::add('/admin_dashboard', function () {
    if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
        header("Location: /views/pages/login.php?message=Access denied");
        exit;
    }
    require(__DIR__ . "/../views/pages/admin_dashboard.php");
});




Route::add('/edit_car', function () {
    if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
        header("Location: /login?message=Access denied");
        exit;
    }

    require_once(__DIR__ . "/../controllers/CarController.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $carName = $_POST['carName'];
        $carController = new CarController();
        $car = $carController->getCarByName($carName);
        if (!$car) {
            header("Location: /admin_dashboard?message=Car not found");
            exit;
        }

        // Store the car data in the session to be used in the edit_car.php file
        $_SESSION['edit_car'] = $car;

        // Include the edit_car.php file to render the page
        require(__DIR__ . "/../views/pages/edit_car.php");
    } else {
        header("Location: /admin_dashboard?message=Invalid request method");
        exit;
    }
}, 'post');

Route::add('/delete_car', function () {
    if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
        header("Location: /views/pages/login.php?message=Access denied");
        exit;
    }

    require_once(__DIR__ . "/../controllers/CarController.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $carId = $_POST['carId'];

        try {
            $carController = new CarController();
            $carController->deleteCarById($carId);

            header("Location: /admin_dashboard?message=Car hidden successfully");
            exit;
        } catch (Exception $e) {
            echo "Failed to hide car: " . $e->getMessage();
        }
    } else {
        header("Location: /admin_dashboard?message=Invalid request method");
        exit;
    }
}, 'post');

Route::add('/register_handler', function () {
    require_once(__DIR__ . "/../controllers/UserController.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $userController = new UserController();
            $userController->create($email, $username, $password);

            // Redirect to the login page with a success message
            header("Location: /views/pages/login.php?message=Registration successful. Please log in.");
            exit;
        } catch (Exception $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    } else {
        // Invalid request method
        header("Location: /views/pages/register.php?message=Invalid request method");
        exit;
    }
}, 'post');




Route::add('/edit_car_handler', function () {
    if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
        header("Location: /views/pages/login.php?message=Access denied");
        exit;
    }

    require_once(__DIR__ . "/../controllers/CarController.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $carId = $_POST['carId'];
        $carName = $_POST['carName'];
        $carPrice = $_POST['carPrice'];
        $carImage = $_POST['carImage'];

        try {
            $carController = new CarController();
            $carController->updateCar($carId, $carName, $carPrice, $carImage);

            header("Location: /admin_dashboard?message=Car updated successfully");
            exit;
        } catch (Exception $e) {
            echo "Failed to update car: " . $e->getMessage();
        }
    } else {
        header("Location: /admin_dashboard?message=Invalid request method");
        exit;
    }
}, 'post');


Route::add('/authenticate', function () {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ob_start(); 
    require_once(__DIR__ . "/../controllers/UserController.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $userPassword = $_POST['password']; 

        try {
            $userController = new UserController();
            $user = $userController->getByEmail($email);

            if ($user && password_verify($userPassword, $user->password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user->Id;
                $_SESSION['username'] = $user->username;
                $_SESSION['role'] = $user->role;

                if ($user->role === 'admin') {
                    header("Location: /admin_dashboard");
                } else {
                    header("Location: /");
                }
                exit;
            } else {
                header("Location: /login?message=Invalid password");
                exit;
            }
        } catch (Exception $e) {
            header("Location: /login?message=" . urlencode($e->getMessage()));
            exit;
        }
    } else {
        header("Location: /login");
        exit;
    }

    ob_end_flush(); 
}, 'post');

Route::add('/history', function () {
    require(__DIR__ . "/../views/pages/history.php");
});

Route::add('/buy', function () {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: /login?message=Please log in to buy a car");
        exit;
    }

    $carId = isset($_GET['car']) ? $_GET['car'] : '';

    if ($carId === '') {
        header("Location: /?message=No car selected for purchase");
        exit;
    }

    require_once(__DIR__ . "/../controllers/UserController.php");
    require_once(__DIR__ . "/../controllers/CarController.php");

    $userController = new UserController();
    $carController = new CarController();

    $userId = $_SESSION['user_id'];

    try {
        $car = $carController->getCarById($carId);
        if (!$car) {
            header("Location: /?message=Car not found");
            exit;
        }

        $userController->addCarToUser($userId, $carId);

        header("Location: /views/pages/history.php?message=Car purchased successfully");
        exit;
    } catch (Exception $e) {
        echo "Failed to buy the car: " . $e->getMessage();
    }
}, 'get');

Route::add('/ajax/add_car', function () {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
        echo json_encode(['status' => 'error', 'message' => 'Access denied']);
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once(__DIR__ . "/../assets/ajax/add_car.php");
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        exit;
    }
}, 'post');