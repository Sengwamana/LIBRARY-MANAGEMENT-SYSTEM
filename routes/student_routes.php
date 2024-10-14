<?php
// student_routes.php
// Remove a specific cookie


session_start();

// Middleware for student access only (and admins/librarians)
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'student' && $_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'librarian')) {
    header("Location: ../pages/login.php");
    exit();
}

// Routing logic for student functionalities
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'view_books':
            include '../pages/book_list.php';
            break;

        case 'view_issued_books':
            include '../pages/issued_books.php';
            break;

        case 'profile':
            include '../pages/user_profile.php';
            break;

        default:
            include '../pages/student_dashboard.php';
            break;
    }
} else {
    // Default route if no action is specified
    include '../pages/student_dashboard.php';
}
?>
