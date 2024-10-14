<?php
// Remove a specific cookie
setcookie("cookieName", "", time() - 3600, "/");

// Disable session cookies
ini_set('session.use_cookies', '0');

// issue_book.php
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

// Fetch available books and users (students)
$book = new Book($conn);
$books = $book->getAvailableBooks();

$user = new User($conn);
$students = $user->getAllStudents();

// Issue book form handling
if (isset($_POST['issue_book'])) {
    $book_id = $_POST['book_id'];
    $student_id = $_POST['student_id'];
    $issue_date = date('Y-m-d');  // Current date

    if ($book->issueBook($book_id, $student_id, $issue_date)) {
        $_SESSION['success'] = "Book issued successfully!";
    } else {
        $_SESSION['error'] = "Failed to issue book. Please try again.";
    }
    header("Location: issue_book.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book - Library Management</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* General Reset and Styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Roboto', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #007bff;
    margin-bottom: 20px;
    text-align: center;
}

/* Form Styling */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

label {
    font-size: 1rem;
    font-weight: bold;
    color: #333;
}

select, button {
    padding: 12px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
    max-width: 500px;
    transition: all 0.3s ease;
}

select:focus, button:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
    outline: none;
}

/* Button Styling */
button {
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    max-width: 200px;
}

button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

button:active {
    transform: scale(0.98);
}

/* Success/Error Messages */
.success-message, .error-message {
    padding: 15px;
    border-radius: 5px;
    font-size: 1rem;
    margin-bottom: 20px;
    text-align: center;
}

.success-message {
    background-color: #28a745;
    color: #fff;
}

.error-message {
    background-color: #dc3545;
    color: #fff;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 1.8rem;
    }

    select, button {
        font-size: 0.9rem;
        padding: 10px;
    }

    button {
        max-width: 100%;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>Issue Book</h2>

        <!-- Display success/error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="issue_book.php" method="POST">
            <!-- Select Book -->
            <label for="book_id">Select Book:</label>
            <select name="book_id" id="book_id" required>
                <option value="">-- Select a Book --</option>
                <?php foreach ($books as $book): ?>
                    <option value="<?php echo $book['id']; ?>"><?php echo htmlspecialchars($book['title']) . " by " . htmlspecialchars($book['author']); ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Select Student -->
            <label for="student_id">Select Student:</label>
            <select name="student_id" id="student_id" required>
                <option value="">-- Select a Student --</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?php echo $student['id']; ?>"><?php echo htmlspecialchars($student['name']); ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Submit Form -->
            <button type="submit" name="issue_book">Issue Book</button>
        </form>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
