<main class="admin-dashboard">
    <div class="container">
        <h1 class="text-center mb-4">Admin Dashboard</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark bg-opacity-75 text-white">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Add Car</h2>
                        <form id="addCarForm" method="post" action="/ajax/add_car" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="carName">Car Name</label>
                                <input type="text" class="form-control" id="carName" name="name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="carPrice">Car Price</label>
                                <input type="number" class="form-control" id="carPrice" name="price" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="carImage">Car Image</label>
                                <input type="file" class="form-control" id="carImage" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add Car</button>
                        </form>
                        <div id="addCarMessage" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Manage Cars</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="carTableBody">
                            <?php
                            require_once(__DIR__ . "/../../controllers/CarController.php");
                            $carController = new CarController();
                            $cars = $carController->getAllCars();
                            foreach ($cars as $car): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($car->name); ?></td>
                                    <td><?php echo htmlspecialchars($car->price); ?></td>
                                    <td><img src="/assets/img/<?php echo htmlspecialchars($car->image_path); ?>" alt="<?php echo htmlspecialchars($car->name); ?>" width="100"></td>
                                    <td>
                                        <form action="/edit_car" method="post" style="display:inline;">
                                            <input type="hidden" name="carName" value="<?php echo htmlspecialchars($car->name); ?>">
                                            <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                        </form>
                                        <form action="/delete_car" method="post" style="display:inline;">
                                            <input type="hidden" name="carId" value="<?php echo htmlspecialchars($car->id); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/assets/js/main.js"></script>