<?php
// user_profile.php
session_start();

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

// Fetch the logged-in user's profile details
$user->id = $_SESSION['user_id'];
$userDetails = $user->getUserById();

// Handle profile update form submission
if (isset($_POST['update_profile'])) {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];

    if ($user->updateProfile()) {
        $_SESSION['success'] = "Profile updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update profile. Please try again.";
    }
    header("Location: user_profile.php");
    exit();
}

// Handle password change form submission
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!$user->verifyPassword($current_password)) {
        $_SESSION['error'] = "Current password is incorrect.";
    } elseif ($new_password !== $confirm_password) {
        $_SESSION['error'] = "New password and confirmation do not match.";
    } else {
        $user->password = $new_password;
        if ($user->updatePassword()) {
            $_SESSION['success'] = "Password updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update password. Please try again.";
        }
    }
    header("Location: user_profile.php");
    exit();
}

// Handle profile picture upload
if (isset($_FILES['profile_picture'])) {
    $target_dir = "../uploads/user_photos/";
    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;

    // Validate image file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);

    if ($check === false) {
        $_SESSION['error'] = "File is not an image.";
    } elseif ($_FILES["profile_picture"]["size"] > 2000000) {
        $_SESSION['error'] = "Sorry, your file is too large.";
    } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $_SESSION['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
    } else {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $user->profile_picture = $file_name;
            if ($user->updateProfilePicture()) {
                $_SESSION['success'] = "Profile picture updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update profile picture.";
            }
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        }
    }
    header("Location: user_profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Library Management</title>
    <link rel="stylesheet" href="../assets/css/user_profile.css">
    <style>
        /* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
}

/* Container */
.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #007bff;
    margin-bottom: 20px;
    text-align: center;
}

h3 {
    color: #333;
    margin-bottom: 10px;
}

/* Form Styles */
.profile-form {
    margin-bottom: 30px;
}

.profile-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.profile-form input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.btn {
    padding: 12px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

/* Profile Picture */
.profile-pic {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    display: block;
    margin: 0 auto 20px;
}

/* Success and Error Messages */
.success-message, .error-message {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    h2, h3 {
        font-size: 1.5rem;
    }

    .btn {
        font-size: 0.9rem;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>User Profile</h2>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Profile Update Form -->
        <form action="user_profile.php" method="POST" class="profile-form">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>" required>

            <button type="submit" name="update_profile" class="btn">Update Profile</button>
        </form>

        <!-- Password Change Form -->
        <h3>Change Password</h3>
        <form action="user_profile.php" method="POST" class="profile-form">
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit" name="change_password" class="btn">Change Password</button>
        </form>

        <!-- Profile Picture Upload -->
        <h3>Update Profile Picture</h3>
        <form action="user_profile.php" method="POST" enctype="multipart/form-data" class="profile-form">
            <?php if ($userDetails['profile_picture']): ?>
                <img src="../uploads/user_photos/<?php echo $userDetails['profile_picture']; ?>" alt="Profile Picture" class="profile-pic">
            <?php endif; ?>
            <input type="file" name="profile_picture" required>
            <button type="submit" class="btn">Upload Picture</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
