<?php
session_start();

// Generate CSRF token if it doesn't exist
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Library Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>

        <form action="../controllers/auth_controller.php" method="POST" autocomplete="off">
            <!-- Name input -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <!-- Email input -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <!-- Password input -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <!-- Role selection -->
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="librarian">Librarian</option>
            </select>

            <!-- CSRF token for security -->
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <!-- Submit button -->
            <button type="submit" name="register">Register</button>
        </form>

        <!-- Display error messages (if any) -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
