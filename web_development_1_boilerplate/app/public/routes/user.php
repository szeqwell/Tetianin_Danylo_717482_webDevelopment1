<?php

require_once(__DIR__ . "/../controllers/UserController.php");

Route::add('/users', function () {
    $userController = new UserController();
    $users = $userController->getAll();
    require_once(__DIR__ . "/../views/pages/users.php");
});

Route::add('/user/([0-9]*)', function ($userId) {
    $userController = new UserController();
    $user = $userController->get($userId);
    require_once(__DIR__ . "/../views/pages/user.php");
});

