<main class="register-page d-flex align-items-center justify-content-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-dark bg-opacity-75 text-white">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Register</h1>
                        <?php if (isset($_GET['message'])): ?>
                            <div class="alert alert-warning text-center">
                                <?php echo htmlspecialchars($_GET['message']); ?>
                            </div>
                        <?php endif; ?>
                        <form action="/register_handler" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username" required>
                                <label for="floatingUsername">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email" required>
                                <label for="floatingEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>