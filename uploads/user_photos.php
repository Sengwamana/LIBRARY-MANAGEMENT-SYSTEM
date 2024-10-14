<?php
// user_photos.php
// Remove a specific cookie
setcookie("cookieName", "", time() - 3600, "/");

// Disable session cookies
ini_set('session.use_cookies', '0');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';
require_once '../models/User.php';

// Database connection
$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

// Handle profile picture upload
if (isset($_FILES['profile_picture'])) {
    // Set the target directory for uploads
    $target_dir = "../uploads/user_photos/";
    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;

    // Get the file extension
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is a real image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error'] = "File is not an image.";
        header("Location: user_photos.php");
        exit();
    }

    // Check file size (limit to 2MB)
    if ($_FILES["profile_picture"]["size"] > 2000000) {
        $_SESSION['error'] = "Sorry, your file is too large.";
        header("Location: user_photos.php");
        exit();
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['error'] = "Only JPG, JPEG, and PNG files are allowed.";
        header("Location: user_photos.php");
        exit();
    }

    // Try to upload the file
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        // Update the user's profile picture in the database
        $user->id = $_SESSION['user_id'];
        $user->profile_picture = $file_name;

        if ($user->updateProfilePicture()) {
            $_SESSION['success'] = "Profile picture updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update profile picture. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
    }

    // Redirect back to the profile page
    header("Location: user_profile.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile Picture - Library Management</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>Update Profile Picture</h2>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Profile Picture Upload Form -->
        <form action="user_photos.php" method="POST" enctype="multipart/form-data">
            <label for="profile_picture">Select a new profile picture:</label>
            <input type="file" name="profile_picture" required>
            <button type="submit">Upload Picture</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
