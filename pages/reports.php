<?php
// Remove a specific cookie
setcookie("cookieName", "", time() - 3600, "/");

// Disable session cookies
ini_set('session.use_cookies', '0');

// reports.php
session_start();

// Middleware for admin access only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
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
$user = new User($conn);

// Fetch reports data
$overdueBooks = $book->getOverdueBooks();
$frequentBooks = $book->getFrequentBooks();
$userActivity = $user->getUserActivity();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Library Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/reports.css">
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
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Page Title */
.page-title {
    text-align: center;
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 20px;
}

.page-title i {
    margin-right: 10px;
    color: #007bff;
}

/* Section Headers */
.report-section h3 {
    font-size: 1.8rem;
    margin-bottom: 10px;
    color: #333;
    position: relative;
}

.report-section h3 i {
    color: #007bff;
    margin-right: 10px;
}

.report-section {
    margin-bottom: 40px;
}

/* Report Tables */
.report-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.report-table th, .report-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

.report-table th {
    background-color: #007bff;
    color: white;
}

.report-table tr:nth-child(even) {
    background-color: #f4f6f9;
}

.report-table tr:hover {
    background-color: #e9ecef;
}

.report-table tr td {
    font-size: 1rem;
    color: #333;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .page-title {
        font-size: 2rem;
    }

    .report-table th, .report-table td {
        padding: 10px 8px;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2 class="page-title"><i class="fas fa-chart-bar"></i> Reports Overview</h2>

        <!-- Overdue Books Report -->
        <section class="report-section">
            <h3><i class="fas fa-exclamation-circle"></i> Overdue Books</h3>
            <?php if (count($overdueBooks) > 0): ?>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Borrower</th>
                            <th>Issue Date</th>
                            <th>Expected Return Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($overdueBooks as $book): ?>
                            <tr>
                                <td><?php echo $book['title']; ?></td>
                                <td><?php echo $book['borrower_name']; ?></td>
                                <td><?php echo $book['issue_date']; ?></td>
                                <td><?php echo $book['expected_return_date']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No overdue books found.</p>
            <?php endif; ?>
        </section>

        <!-- Frequently Borrowed Books Report -->
        <section class="report-section">
            <h3><i class="fas fa-book-open"></i> Frequently Borrowed Books</h3>
            <?php if (count($frequentBooks) > 0): ?>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>Times Borrowed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($frequentBooks as $book): ?>
                            <tr>
                                <td><?php echo $book['title']; ?></td>
                                <td><?php echo $book['borrow_count']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No data for frequently borrowed books.</p>
            <?php endif; ?>
        </section>

        <!-- User Activity Report -->
        <section class="report-section">
            <h3><i class="fas fa-users"></i> User Activity</h3>
            <?php if (count($userActivity) > 0): ?>
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Last Activity</th>
                            <th>Books Borrowed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($userActivity as $activity): ?>
                            <tr>
                                <td><?php echo $activity['name']; ?></td>
                                <td><?php echo $activity['last_activity']; ?></td>
                                <td><?php echo $activity['books_borrowed']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No user activity found.</p>
            <?php endif; ?>
        </section>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
