<?php
// book_api.php
header("Content-Type: application/json");
require_once '../config/db.php';
require_once '../models/Book.php';

$db = new Database();
$conn = $db->getConnection();
$book = new Book($conn);

// Fetch all books (AJAX call)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $book->getBooks();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($books);
    exit();
}

// Search for books by title (AJAX search)
if (isset($_GET['search'])) {
    $query = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ?");
    $stmt->execute(["%$query%"]);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($books);
    exit();
}
?>
