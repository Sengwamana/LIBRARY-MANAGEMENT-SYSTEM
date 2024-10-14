<?php
// Import necessary files
require_once '../config/db.php';
require_once '../models/User.php';

session_start();  // Always start session

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

// CSRF token validation function
function validateCsrfToken() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("CSRF token validation failed.");
        }
    }
}

// Generate CSRF token (if not already set)
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Register a new user
if (isset($_POST['register'])) {
    validateCsrfToken();  // Check CSRF token

    // Sanitize inputs to prevent XSS
    $user->name = htmlspecialchars(strip_tags($_POST['name']));
    $user->email = htmlspecialchars(strip_tags($_POST['email']));
    $user->password = $_POST['password'];  // Hashing happens in the model
    $user->role = htmlspecialchars(strip_tags($_POST['role'])); // 'student' or 'librarian'

    // Register the user
    if ($user->register()) {
        header("Location: ../pages/login.php?success=registered");
        exit();
    } else {
        header("Location: ../pages/register.php?error=registration_failed");
        exit();
    }
}

// Login the user
if (isset($_POST['login'])) {
    validateCsrfToken();  // Check CSRF token

    // Sanitize inputs
    $user->email = htmlspecialchars(strip_tags($_POST['email']));
    $password = $_POST['password'];  // Plain password for verification

    // Fetch user details by email
    $userRecord = $user->getUserByEmail($user->email);

    // Debugging output
    if (!$userRecord) {
        header("Location: ../pages/login.php?error=User not found");
        exit();
    }

    // Verify the password
    if (password_verify($password, $userRecord['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $userRecord['id'];
        $_SESSION['role'] = $userRecord['role'];

        // Secure the session by regenerating session ID
        session_regenerate_id(true);

        // Redirect to dashboard
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        header("Location: ../pages/login.php");
        exit();
    }
}

// Logout the user
if (isset($_GET['logout'])) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset();   // Unset session variables
    session_destroy(); // Destroy the session

    // Redirect to home page
    header("Location: ../pages/home.php");
    exit();
}
?>
