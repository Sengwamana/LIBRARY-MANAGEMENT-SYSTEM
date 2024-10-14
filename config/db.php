<?php
class Database {
    private $host = "localhost";
    private $db_name = "library_management";
    private $username = "root";
    private $password = "";
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            // Create a PDO connection with the database
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            
            // Set PDO attributes for error handling
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Use exceptions for errors
            $this->conn->exec("set names utf8"); // Ensure UTF-8 encoding
        } catch(PDOException $exception) {
            // More detailed error reporting for development (you may want to log this instead of displaying it)
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
