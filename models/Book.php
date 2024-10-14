<?php
class Book {
    private $conn;
    private $table_name = "books";

    public $id;
    public $title;
    public $author;
    public $isbn;
    public $cover_image;
    public $status; // 'available', 'issued'

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all books
    public function getBooks() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY title ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch available books
    public function getAvailableBooks() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE status = 'available'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new book
    public function addBook() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, author=:author, isbn=:isbn, cover_image=:cover_image, status='available'";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(":title", htmlspecialchars(strip_tags($this->title)));
        $stmt->bindParam(":author", htmlspecialchars(strip_tags($this->author)));
        $stmt->bindParam(":isbn", htmlspecialchars(strip_tags($this->isbn)));
        $stmt->bindParam(":cover_image", $this->cover_image);

        return $stmt->execute();
    }

    // Update book status
    public function updateStatus($status) {
        $query = "UPDATE " . $this->table_name . " SET status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Issue a book to a student
    public function issueBook($book_id, $student_id, $issue_date) {
        // Begin transaction
        $this->conn->beginTransaction();

        try {
            // Insert into transactions table
            $query = "INSERT INTO transactions (book_id, user_id, issue_date, status) VALUES (:book_id, :user_id, :issue_date, 'issued')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":book_id", $book_id);
            $stmt->bindParam(":user_id", $student_id);
            $stmt->bindParam(":issue_date", $issue_date);

            // Execute the transaction query
            if ($stmt->execute()) {
                // Update the book status to 'issued'
                $updateQuery = "UPDATE " . $this->table_name . " SET status = 'issued' WHERE id = :book_id";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(":book_id", $book_id);

                if ($updateStmt->execute()) {
                    // Commit the transaction
                    $this->conn->commit();
                    return true;
                } else {
                    throw new Exception("Failed to update book status.");
                }
            } else {
                throw new Exception("Failed to issue book.");
            }
        } catch (Exception $e) {
            // Rollback transaction in case of failure
            $this->conn->rollBack();
            return false;
        }
    }

    // Get currently issued books
    public function getIssuedBooks() {
        $query = "
            SELECT books.id, books.title, users.name AS borrower_name
            FROM books
            JOIN transactions ON books.id = transactions.book_id
            JOIN users ON transactions.user_id = users.id
            WHERE books.status = 'issued' AND transactions.status = 'issued'";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Return a book
    public function returnBook($book_id, $return_date) {
        // Start a transaction
        $this->conn->beginTransaction();

        try {
            // Update the transaction status to 'returned' and set the return date
            $query = "UPDATE transactions SET status = 'returned', return_date = :return_date WHERE book_id = :book_id AND status = 'issued'";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":return_date", $return_date);
            $stmt->bindParam(":book_id", $book_id);

            if ($stmt->execute()) {
                // Update the book status to 'available'
                $updateQuery = "UPDATE books SET status = 'available' WHERE id = :book_id";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(":book_id", $book_id);

                if ($updateStmt->execute()) {
                    // Commit the transaction
                    $this->conn->commit();
                    return true;
                } else {
                    throw new Exception("Failed to update book status.");
                }
            } else {
                throw new Exception("Failed to update transaction status.");
            }
        } catch (Exception $e) {
            // Rollback transaction in case of failure
            $this->conn->rollBack();
            return false;
        }
    }

    // Get list of overdue books
    public function getOverdueBooks() {
        $query = "
            SELECT books.title, users.name AS borrower_name, transactions.issue_date, transactions.return_date AS expected_return_date 
            FROM transactions
            JOIN books ON books.id = transactions.book_id
            JOIN users ON users.id = transactions.user_id
            WHERE transactions.status = 'issued' AND transactions.return_date IS NULL AND transactions.issue_date < CURDATE() - INTERVAL 30 DAY";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get list of most frequently borrowed books
    public function getFrequentBooks() {
        $query = "
            SELECT books.title, COUNT(transactions.id) AS borrow_count
            FROM transactions
            JOIN books ON books.id = transactions.book_id
            WHERE transactions.status = 'issued' OR transactions.status = 'returned'
            GROUP BY books.id
            ORDER BY borrow_count DESC
            LIMIT 10";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch issued books by user ID
    public function getIssuedBooksByUserId($userId) {
        $query = "
            SELECT books.title, books.author, transactions.issue_date, transactions.return_date 
            FROM transactions 
            JOIN books ON transactions.book_id = books.id 
            WHERE transactions.user_id = :user_id AND transactions.status = 'issued'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Upload book cover image
    public function uploadBook($file) {
        // Directory where images will be stored
        $targetDir = "../uploads/book_covers/"; // Ensure this directory exists and is writable
        $targetFile = $targetDir . basename($file["name"]);
        $uploadOk = 1;

        // Check if the file is a valid image
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);

        if ($check === false) {
            return "File is not an image.";
        }

        // Check file size (limit to 2MB)
        if ($file["size"] > 2000000) {
            return "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            return "Sorry, file already exists.";
        }

        // Try to upload the file
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            $this->cover_image = $targetFile; // Set the cover image path
            return true; // Return true on success
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }
}
?>
