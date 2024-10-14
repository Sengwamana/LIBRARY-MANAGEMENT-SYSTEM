<?php
// user_controller.php
require_once '../config/db.php';
require_once '../models/User.php';

session_start();

// Database connection
$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Handle updating user profile information
if (isset($_POST['update_profile'])) {
    $user->id = $_SESSION['user_id'];
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];

    if ($user->updateProfile()) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: ../pages/user_profile.php");
    } else {
        $_SESSION['error'] = "Failed to update profile. Please try again.";
        header("Location: ../pages/user_profile.php");
    }
}

// Handle password change
if (isset($_POST['change_password'])) {
    $user->id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the current password matches the user's existing password
    if (!$user->verifyPassword($current_password)) {
        $_SESSION['error'] = "Current password is incorrect.";
        header("Location: ../pages/user_profile.php");
        exit();
    }

    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "New password and confirm password do not match.";
        header("Location: ../pages/user_profile.php");
        exit();
    }

    // Update the password
    $user->password = $new_password;
    if ($user->updatePassword()) {
        $_SESSION['success'] = "Password updated successfully!";
        header("Location: ../pages/user_profile.php");
    } else {
        $_SESSION['error'] = "Failed to update password. Please try again.";
        header("Location: ../pages/user_profile.php");
    }
}

// Handle profile picture upload
if (isset($_FILES['profile_picture'])) {
    $user->id = $_SESSION['user_id'];

    // Handle file upload and save the file path in the user's profile
    $target_dir = "../uploads/user_photos/";
    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;

    // Check for valid image file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error'] = "File is not an image.";
        header("Location: ../pages/user_profile.php");
        exit();
    }

    // Check file size (limit to 2MB)
    if ($_FILES["profile_picture"]["size"] > 2000000) {
        $_SESSION['error'] = "Sorry, your file is too large.";
        header("Location: ../pages/user_profile.php");
        exit();
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $_SESSION['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        header("Location: ../pages/user_profile.php");
        exit();
    }

    // Attempt to move the uploaded file
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        // Save file path in the database
        $user->profile_picture = $file_name;
        if ($user->updateProfilePicture()) {
            $_SESSION['success'] = "Profile picture updated successfully!";
            header("Location: ../pages/user_profile.php");
        } else {
            $_SESSION['error'] = "Failed to update profile picture. Please try again.";
            header("Location: ../pages/user_profile.php");
        }
    } else {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        header("Location: ../pages/user_profile.php");
    }
}

?>
