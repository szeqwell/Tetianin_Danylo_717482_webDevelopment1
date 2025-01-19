<nav class="nav">
    <a class="nav-link text-white" href="/">Home</a>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['role'] === 'admin'): ?>
        <a class="nav-link text-white" href="/admin_dashboard">Admin</a>
    <?php else: ?>
        <a class="nav-link text-white" href="/history">History</a>
    <?php endif; ?>
    <a class="nav-link text-white" href="/register">Register</a>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <a class="nav-link text-white" href="/views/pages/logout.php">Log out</a>
    <?php else: ?>
        <a class="nav-link text-white" href="/login">Log in</a>
    <?php endif; ?>
</nav>