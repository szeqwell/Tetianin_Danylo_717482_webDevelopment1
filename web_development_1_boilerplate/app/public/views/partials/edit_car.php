<main class="edit-car-page">
    <div class="container">
        <h1 class="text-center mb-4">Edit Car</h1>
        <form action="/edit_car_handler" method="post">
            <input type="hidden" name="carId" value="<?php echo htmlspecialchars($car->id); ?>">
            <div class="form-group">
                <label for="carName">Car Name</label>
                <input type="text" class="form-control" id="carName" name="carName" value="<?php echo htmlspecialchars($car->name); ?>" required>
            </div>
            <div class="form-group">
                <label for="carPrice">Car Price</label>
                <input type="number" class="form-control" id="carPrice" name="carPrice" value="<?php echo htmlspecialchars($car->price); ?>" required>
            </div>
            <div class="form-group">
                <label for="carImage">Car Image Path</label>
                <input type="text" class="form-control" id="carImage" name="carImage" value="<?php echo htmlspecialchars($car->image_path); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Car</button>
        </form>
    </div>
</main>