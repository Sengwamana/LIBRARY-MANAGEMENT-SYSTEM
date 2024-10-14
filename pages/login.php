
    <?php include '../controllers/user_controller.php'; ?>
<?php
session_start();

// Redirect to dashboard if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Flash messages (e.g., successful registration)
$successMessage = '';
if (isset($_GET['success']) && $_GET['success'] === 'registered') {
    $successMessage = "Registration successful. You can now log in.";
}

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <!-- Display success message if available -->
        <?php if ($successMessage): ?>
            <p class="success"><?php echo htmlspecialchars($successMessage); ?></p>
        <?php endif; ?>

        <!-- Login form -->
        <form action="../controllers/auth_controller.php" method="POST" autocomplete="off">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required aria-label="Email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required aria-label="Password">

            <!-- CSRF token for security -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <button type="submit" name="login">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>

        <!-- Display error message if available -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
