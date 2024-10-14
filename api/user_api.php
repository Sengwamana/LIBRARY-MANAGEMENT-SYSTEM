<?php
// user_api.php
header("Content-Type: application/json");
header("X-Content-Type-Options: nosniff");
require_once '../config/db.php';
require_once '../models/User.php';

$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

try {
    // Update user profile
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if data is coming from POST or raw JSON body
        $input = file_get_contents('php://input');
        $data = json_decode($input, true) ?? $_POST;

        // Validate inputs
        if (!isset($data['user_id'], $data['name'], $data['email'])) {
            echo json_encode(["message" => "Invalid input data."]);
            http_response_code(400);
            exit();
        }

        // Sanitize inputs
        $user->id = filter_var($data['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $user->name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $user->email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);

        // Validate email format
        if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["message" => "Invalid email format."]);
            http_response_code(400);
            exit();
        }

        // Update the user in the database
        $query = "UPDATE users SET name=:name, email=:email WHERE id=:id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':id', $user->id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Profile updated successfully!"]);
            http_response_code(200);
        } else {
            echo json_encode(["message" => "Failed to update profile."]);
            http_response_code(500);
        }
    } else {
        echo json_encode(["message" => "Invalid request method."]);
        http_response_code(405); // Method Not Allowed
    }
} catch (Exception $e) {
    echo json_encode(["message" => "Server error: " . $e->getMessage()]);
    http_response_code(500); // Internal Server Error
}
?>
