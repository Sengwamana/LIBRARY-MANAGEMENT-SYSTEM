<?php
// return_book.php

// Remove a specific cookie
setcookie("cookieName", "", time() - 3600, "/");

// Disable session cookies
ini_set('session.use_cookies', '0');

session_start();

// Middleware for admin/librarian access
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'librarian')) {
    header("Location: login.php");
    exit();
}

require_once '../config/db.php';
require_once '../models/Book.php';
require_once '../models/User.php';

// Database connection
$db = new Database();
$conn = $db->getConnection();
$book = new Book($conn);

// Fetch issued books
$issuedBooks = $book->getIssuedBooks();

// Handle return book form submission
if (isset($_POST['return_book'])) {
    $book_id = $_POST['book_id'];
    $return_date = date('Y-m-d');  // Current date

    if ($book->returnBook($book_id, $return_date)) {
        $_SESSION['success'] = "Book returned successfully!";
    } else {
        $_SESSION['error'] = "Failed to return book. Please try again.";
    }
    header("Location: return_book.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book - Library Management</title>
    <link rel="stylesheet" href="../assets/css/return_book.css">
    <style>
        /* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 2.5rem;
    color: #007bff;
    text-align: center;
    margin-bottom: 20px;
}

h2 i {
    margin-right: 10px;
    color: #007bff;
}

/* Form Styling */
.return-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

select {
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 100%;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.2s ease;
}

select:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
}

.btn-return {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    background-color: #28a745;
    color: white;
    font-size: 1.2rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-return:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

.btn-return i {
    margin-right: 10px;
}

/* Success/Error Messages */
.success-message, .error-message {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
    font-size: 1.1rem;
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
        padding: 15px;
    }

    h2 {
        font-size: 2rem;
    }

    .btn-return {
        font-size: 1.1rem;
        padding: 10px 15px;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2><i class="fas fa-book-return"></i> Return Issued Book</h2>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Form to return the book -->
        <form action="return_book.php" method="POST" class="return-form">
            <!-- Select Issued Book -->
            <label for="book_id">Select Issued Book:</label>
            <select name="book_id" id="book_id" required>
                <option value="">-- Select a Book to Return --</option>
                <?php foreach ($issuedBooks as $book): ?>
                    <option value="<?php echo $book['id']; ?>">
                        <?php echo $book['title'] . " (Issued to " . $book['borrower_name'] . ")"; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Submit the form -->
            <button type="submit" name="return_book" class="btn-return"><i class="fas fa-book"></i> Return Book</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
