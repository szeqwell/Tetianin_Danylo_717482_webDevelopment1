<?php
require_once("dbconfig.php");
try{
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM posts";
$result = $connection->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Guestbook</title>
</head>
<body>
<div class="container">
        <h1>Guestbook</h1>

        
        <?php foreach ($result as $row): ?>
            <div class="post">
                <p class="name"><?php echo htmlspecialchars($row['name']); ?></p>
                <p class="message"><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                <p class="posted-at">Posted at: <?php echo htmlspecialchars($row['posted_at']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>