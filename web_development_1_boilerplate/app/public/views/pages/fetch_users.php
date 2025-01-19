<?php
require_once(__DIR__ . "/../../controllers/UserController.php");

$userController = new UserController();
$users = $userController->getAll();

if (!empty($users)) {
    echo "<table border='1'>";
    echo "<tr><th>Id</th><th>Username</th><th>Email</th></tr>";
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user->Id) . "</td>";
        echo "<td>" . htmlspecialchars($user->username) . "</td>";
        echo "<td>" . htmlspecialchars($user->email) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}
?>