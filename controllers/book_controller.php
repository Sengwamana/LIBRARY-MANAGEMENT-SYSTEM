<?php
// book_controller.php
require_once '../config/db.php';
require_once '../models/Book.php';

$db = new Database();
$conn = $db->getConnection();
$book = new Book($conn);

// Add a new book
if (isset($_POST['add_book'])) {
    $book->title = $_POST['title'];
    $book->author = $_POST['author'];
    $book->isbn = $_POST['isbn'];
    $book->cover_image = $_POST['cover_image']; // Assuming file upload handling is implemented

    if ($book->addBook()) {
        header("Location: ../pages/book_list.php?success=book_added");
    } else {
        echo "Failed to add the book!";
    }
}

// Issue a book
if (isset($_POST['issue_book'])) {
    $book->id = $_POST['book_id'];
    $status = 'issued'; // Change to 'available' for return
    if ($book->updateStatus($status)) {
        header("Location: ../pages/book_list.php?success=book_issued");
    } else {
        echo "Failed to issue the book!";
    }
}
require_once '../services/notification_service.php';

if (isset($_POST['issue_book'])) {
    // After issuing the book...
    $notificationService = new NotificationService();
    $userEmail = 'user@example.com';  // Fetch from the user's data
    $subject = 'Book Issued: ' . $book->title;
    $body = "Hello, <br>Your book '{$book->title}' has been successfully issued.<br>Return it by the due date.";

    if ($notificationService->sendEmail($userEmail, $subject, $body)) {
        echo "Email notification sent successfully!";
    } else {
        echo "Failed to send email notification.";
    }
}

?>

