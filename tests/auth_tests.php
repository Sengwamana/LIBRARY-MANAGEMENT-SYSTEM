<?php
// auth_tests.php

require_once '../config/db.php';
require_once '../models/User.php';

class AuthTests {

    private $conn;
    private $user;

    public function __construct() {
        // Initialize database connection
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->user = new User($this->conn);
    }

    // Test registration functionality
    public function testRegistration() {
        echo "Testing registration...\n";

        // Mock user data
        $this->user->name = 'Test User';
        $this->user->email = 'testuser@example.com';
        $this->user->password = 'password123';
        $this->user->role = 'student';

        // Try registering the user
        if ($this->user->register()) {
            echo "Registration test passed!\n";
        } else {
            echo "Registration test failed!\n";
        }
    }

    // Test login functionality
    public function testLogin() {
        echo "Testing login...\n";

        // Mock login data
        $this->user->email = 'testuser@example.com';
        $this->user->password = 'password123';

        // Try logging in the user
        if ($this->user->login()) {
            echo "Login test passed!\n";
        } else {
            echo "Login test failed!\n";
        }
    }

    // Test incorrect login (invalid password)
    public function testIncorrectLogin() {
        echo "Testing incorrect login...\n";

        // Mock login data with incorrect password
        $this->user->email = 'testuser@example.com';
        $this->user->password = 'wrongpassword';

        // Try logging in with the wrong password
        if (!$this->user->login()) {
            echo "Incorrect login test passed!\n";
        } else {
            echo "Incorrect login test failed!\n";
        }
    }

    // Test password verification
    public function testPasswordVerification() {
        echo "Testing password verification...\n";

        // Mock user password verification
        $this->user->id = 1;  // Assuming the user ID is 1
        $current_password = 'password123';

        // Verify the password
        if ($this->user->verifyPassword($current_password)) {
            echo "Password verification test passed!\n";
        } else {
            echo "Password verification test failed!\n";
        }
    }

    // Test updating password
    public function testUpdatePassword() {
        echo "Testing password update...\n";

        // Mock new password
        $this->user->id = 1;  // Assuming the user ID is 1
        $new_password = 'newpassword123';
        $this->user->password = $new_password;

        // Try updating the password
        if ($this->user->updatePassword()) {
            echo "Password update test passed!\n";
        } else {
            echo "Password update test failed!\n";
        }
    }

    // Test deleting user after tests (cleanup)
    public function testDeleteUser() {
        echo "Cleaning up test data...\n";

        // Mock email
        $this->user->email = 'testuser@example.com';

        // Try deleting the user
        $query = "DELETE FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->user->email);

        if ($stmt->execute()) {
            echo "Test user deleted successfully!\n";
        } else {
            echo "Failed to delete test user!\n";
        }
    }
}

// Running the tests
$authTests = new AuthTests();
$authTests->testRegistration();
$authTests->testLogin();
$authTests->testIncorrectLogin();
$authTests->testPasswordVerification();
$authTests->testUpdatePassword();
$authTests->testDeleteUser();
?>
