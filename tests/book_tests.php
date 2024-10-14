<?php
// book_tests.php
require_once '../config/db.php';
require_once '../models/Book.php';

$db = new Database();
$conn = $db->getConnection();
$book = new Book($conn);

// Test fetching all books
$stmt = $book->getBooks();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($books)) {
    echo "Book fetching test passed!\n";
} else {
    echo "Book fetching test failed!\n";
}
?>
