<?php
// librarian_routes.php


session_start();

// Middleware for librarian access only
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'librarian' && $_SESSION['role'] !== 'admin')) {
    header("Location: ../pages/login.php");
    exit();
}

// Routing logic for librarian functionalities
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'issue_book':
            include '../pages/issue_book.php';
            break;

        case 'return_book':
            include '../pages/return_book.php';
            break;

        case 'manage_books':
            include '../pages/manage_books.php';
            break;

        case 'add_book':
            include '../pages/add_book.php';
            break;

        default:
            include '../pages/librarian_dashboard.php';
            break;
    }
} else {
    // Default route if no action is specified
    include '../pages/librarian_dashboard.php';
}
?>
