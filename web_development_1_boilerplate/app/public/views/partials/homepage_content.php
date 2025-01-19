<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/../../controllers/CarController.php");

$carController = new CarController();

try {
    $cars = $carController->getAllCars();
} catch (Exception $e) {
    echo "Failed to fetch car data: " . $e->getMessage();
}
?>
<main class="homepage">
    <section class="quote-section text-center text-white py-5">
        <div class="container">
            <blockquote class="blockquote">
                <p class="mb-4">
                    <em>"The way I drive, the way I handle a car, is an expression of my inner feelings."</em>
                </p>
                <footer class="blockquote-footer text-warning">Lewis Hamilton</footer>
            </blockquote>
        </div>
    </section>

    <section class="featured-cars text-center text-white py-5">
        <div class="container">
            <h1 class="mb-4">Our Featured Cars</h1>
            <div class="row g-4">
                <?php if (!empty($cars)): ?>
                    <?php foreach ($cars as $car): ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-dark bg-opacity-75 text-white car-card">
                                <img src="/assets/img/<?php echo htmlspecialchars($car->image_path); ?>" class="card-img-top rounded" alt="<?php echo htmlspecialchars($car->name); ?>">
                                <div class="card-body">
                                    <h2 class="card-title h5"><?php echo htmlspecialchars($car->name); ?></h2>
                                    <p class="card-text text-warning fw-bold">€<?php echo htmlspecialchars($car->price); ?></p>
                                    <a href="/buy?car=<?php echo urlencode($car->id); ?>" class="btn btn-primary btn-sm custom-btn">Buy</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">No cars available at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>