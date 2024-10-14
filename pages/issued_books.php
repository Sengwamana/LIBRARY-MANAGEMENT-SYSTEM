<?php
// Remove a specific cookie
setcookie("cookieName", "", time() - 3600, "/");

// Disable session cookies
ini_set('session.use_cookies', '0');

session_start();

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['student', 'admin', 'librarian'])) {
    header("Location: login.php");
    exit();
}

require '../config/db.php';
require '../models/Book.php';

// Database connection
$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$book = new Book($conn);

// Fetch books issued to the current user
$issuedBooks = $book->getIssuedBooksByUserId($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books - Library Management</title>
    <link rel="stylesheet" href="../assets/css/issued_books.css">
    <style>
        /* General Reset and Styling */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f9f9f9;
    color: #333;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
}

/* Container */
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

/* Responsive Table */
.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table thead th {
    background-color: #007bff;
    color: #fff;
    padding: 12px;
    text-align: left;
}

table tbody td {
    padding: 12px;
    border: 1px solid #ddd;
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Hover Effect */
table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Message Styling */
p {
    text-align: center;
    font-size: 1.1em;
    margin: 20px 0;
    color: #666;
}

/* Responsive Design for Mobile Devices */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 1.8rem;
    }

    table thead th, table tbody td {
        padding: 10px;
        font-size: 0.9rem;
    }

    p {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>Issued Books</h2>

        <?php if (count($issuedBooks) > 0): ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Issue Date</th>
                            <th>Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($issuedBooks as $book): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($book['title']); ?></td>
                                <td><?php echo htmlspecialchars($book['author']); ?></td>
                                <td><?php echo htmlspecialchars($book['issue_date']); ?></td>
                                <td><?php echo htmlspecialchars($book['return_date'] ? $book['return_date'] : 'Not returned yet'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No books issued at the moment.</p>
        <?php endif; ?>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
