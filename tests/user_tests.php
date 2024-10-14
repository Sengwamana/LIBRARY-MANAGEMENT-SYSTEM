<?php
// user_tests.php
require_once '../config/db.php';
require_once '../models/User.php';

$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

// Test registration
$user->name = "John Doe";
$user->email = "john@example.com";
$user->password = "password123";
$user->role = "student";

if ($user->register()) {
    echo "User registration test passed!\n";
} else {
    echo "User registration test failed!\n";
}

// Test login
$user->email = "john@example.com";
$user->password = "password123";

if ($user->login()) {
    echo "User login test passed!\n";
} else {
    echo "User login test failed!\n";
}
?>
