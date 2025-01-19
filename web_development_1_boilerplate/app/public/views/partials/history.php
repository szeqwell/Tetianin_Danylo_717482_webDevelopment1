<main class="history-page">
    <div class="container">
        <h1 class="text-center mb-4">Purchase History</h1>
        <?php if (!empty($purchaseHistory)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Car Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Purchase Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchaseHistory as $purchase): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($purchase->name); ?></td>
                                <td><?php echo htmlspecialchars($purchase->price); ?></td>
                                <td><img src="/assets/img/<?php echo htmlspecialchars($purchase->image_path); ?>" alt="<?php echo htmlspecialchars($purchase->name); ?>" width="100"></td>
                                <td><?php echo htmlspecialchars($purchase->purchase_date); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">You have not purchased any cars yet.</p>
        <?php endif; ?>
    </div>
</main>