<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $profile_picture;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new user
    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);

        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        // Sanitize input
        $sanitized_name = htmlspecialchars(strip_tags($this->name));
        $sanitized_email = htmlspecialchars(strip_tags($this->email));

        // Bind parameters
        $stmt->bindParam(":name", $sanitized_name);
        $stmt->bindParam(":email", $sanitized_email);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":role", $this->role);

        return $stmt->execute();
    }

    // Get user by email (used for login)
    public function getUserByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Sanitize the email
        $sanitized_email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(':email', $sanitized_email);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Log in the user
    public function login() {
        // Sanitize email before using it in the query
        $sanitized_email = htmlspecialchars(strip_tags($this->email));

        // Get user record by email
        $user = $this->getUserByEmail($sanitized_email);

        // Check if user exists and verify password
        if ($user && password_verify($this->password, $user['password'])) {
            // Set user details in class properties for session management
            $this->id = $user['id'];
            $this->role = $user['role'];
            return true;
        }

        return false;
    }

    // Get user details by ID
    public function getUserById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user profile (name and email)
    public function updateProfile() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $sanitized_name = htmlspecialchars(strip_tags($this->name));
        $sanitized_email = htmlspecialchars(strip_tags($this->email));

        // Bind parameters
        $stmt->bindParam(":name", $sanitized_name);
        $stmt->bindParam(":email", $sanitized_email);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Verify user's current password
    public function verifyPassword($current_password) {
        $query = "SELECT password FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return password_verify($current_password, $user['password']);
    }

    // Update user password
    public function updatePassword() {
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Hash the new password
        $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind parameters
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Update user profile picture
    public function updateProfilePicture() {
        $query = "UPDATE " . $this->table_name . " SET profile_picture = :profile_picture WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":profile_picture", $this->profile_picture);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Get all students
    public function getAllStudents() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE role = 'student'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get user activity (e.g., books borrowed, last activity)
    public function getUserActivity() {
        $query = "
            SELECT users.name, MAX(transactions.issue_date) AS last_activity, COUNT(transactions.id) AS books_borrowed
            FROM users
            JOIN transactions ON users.id = transactions.user_id
            WHERE users.role = 'student'
            GROUP BY users.id
            ORDER BY last_activity DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
