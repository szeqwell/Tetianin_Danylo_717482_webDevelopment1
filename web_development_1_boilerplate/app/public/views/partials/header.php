
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Dealership</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    
</head>
<body>
<header class="bg-dark bg-opacity-75 text-white sticky-top">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <h1 class="logo m-0">Mercedes CarDeal</h1>
        <div class="ms-auto d-flex align-items-center">
            <?php require(__DIR__ . "/header_nav.php")?>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <span class="ms-3 fw-bold text-warning">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
            <?php endif; ?>
        </div>
    </div>
</header>