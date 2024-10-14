<?php
// book_uploads.php
// Remove a specific cookie
setcookie("cookieName", "", time() - 3600, "/");

// Disable session cookies
ini_set('session.use_cookies', '0');

session_start();

// Middleware for librarian/admin access only
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'librarian' && $_SESSION['role'] !== 'admin')) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';
require_once '../models/Book.php';

// Database connection
$db = new Database();
$conn = $db->getConnection();
$book = new Book($conn);

// Handle book upload form submission
if (isset($_POST['upload_book'])) {
    $book->title = $_POST['title'];
    $book->author = $_POST['author'];
    $book->isbn = $_POST['isbn'];

    // Handle cover image upload
    $cover_dir = "../uploads/book_covers/";
    $cover_name = uniqid() . "_" . basename($_FILES["cover_image"]["name"]);
    $cover_file = $cover_dir . $cover_name;
    $cover_image_type = strtolower(pathinfo($cover_file, PATHINFO_EXTENSION));

    // Validate cover image
    $check = getimagesize($_FILES["cover_image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error'] = "File is not a valid image.";
        header("Location: book_uploads.php");
        exit();
    } elseif ($_FILES["cover_image"]["size"] > 2000000) { // Limit file size to 2MB
        $_SESSION['error'] = "Sorry, the cover image file is too large.";
        header("Location: book_uploads.php");
        exit();
    } elseif (!in_array($cover_image_type, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['error'] = "Only JPG, JPEG, and PNG files are allowed for the cover image.";
        header("Location: book_uploads.php");
        exit();
    } else {
        // Move the cover image to the designated folder
        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $cover_file)) {
            $book->cover_image = $cover_name;
        } else {
            $_SESSION['error'] = "Failed to upload the cover image.";
            header("Location: book_uploads.php");
            exit();
        }
    }

    // Handle eBook (PDF) upload
    $book_dir = "../uploads/book_uploads/";
    $book_name = uniqid() . "_" . basename($_FILES["book_file"]["name"]);
    $book_file = $book_dir . $book_name;
    $book_file_type = strtolower(pathinfo($book_file, PATHINFO_EXTENSION));

    // Validate book file (PDF)
    if ($book_file_type !== 'pdf') {
        $_SESSION['error'] = "Only PDF files are allowed for the book.";
        header("Location: book_uploads.php");
        exit();
    } elseif ($_FILES["book_file"]["size"] > 5000000) { // Limit file size to 5MB
        $_SESSION['error'] = "Sorry, the book file is too large.";
        header("Location: book_uploads.php");
        exit();
    } else {
        // Move the book file to the designated folder
        if (move_uploaded_file($_FILES["book_file"]["tmp_name"], $book_file)) {
            $book->book_file = $book_name;
        } else {
            $_SESSION['error'] = "Failed to upload the book file.";
            header("Location: book_uploads.php");
            exit();
        }
    }

    // Save book details to the database
    if ($book->uploadBook()) {
        $_SESSION['success'] = "Book uploaded successfully!";
    } else {
        $_SESSION['error'] = "Failed to upload the book details.";
    }
    header("Location: book_uploads.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book - Library Management</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>Upload New Book</h2>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <!-- Book Upload Form -->
        <form action="book_uploads.php" method="POST" enctype="multipart/form-data">
            <label for="title">Book Title:</label>
            <input type="text" name="title" required>

            <label for="author">Author:</label>
            <input type="text" name="author" required>

            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn" required>

            <label for="cover_image">Cover Image (JPG, JPEG, PNG):</label>
            <input type="file" name="cover_image" required>

            <label for="book_file">Upload Book (PDF):</label>
            <input type="file" name="book_file" required>

            <button type="submit" name="upload_book">Upload Book</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
