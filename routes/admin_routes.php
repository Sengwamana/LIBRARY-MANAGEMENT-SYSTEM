<?php
// admin_routes.php

session_start();

// Middleware for admin access only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

// Routing logic for admin functionalities
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'manage_users':
            include '../pages/manage_users.php';
            break;

        case 'manage_books':
            include '../pages/manage_books.php';
            break;

        case 'view_reports':
            include '../pages/reports.php';
            break;

        case 'add_user':
            include '../pages/add_user.php';
            break;

        case 'add_book':
            include '../pages/add_book.php';
            break;

        default:
            include '../pages/admin_dashboard.php';
            break;
    }
} else {
    // Default route if no action is specified
    include '../pages/admin_dashboard.php';
}
?>
