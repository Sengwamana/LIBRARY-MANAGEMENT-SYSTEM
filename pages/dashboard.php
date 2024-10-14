<?php
require_once '../config/config.php';
require_once '../middleware/auth_middleware.php';

session_start();
checkAuth(); // Ensures that only logged-in users can access this page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Library Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <style>
        /* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 2.2rem;
    color: #007bff;
    text-align: center;
    margin-bottom: 30px;
}

p {
    font-size: 1.2rem;
    text-align: center;
    margin-bottom: 40px;
    color: #555;
}

/* Card Container */
.card-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
}

/* Card Styles */
.card {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 250px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 123, 255, 0.2);
}

.card-icon {
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 10px;
}

.card h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #333;
}

.card a {
    text-decoration: none;
    color: inherit;
    font-weight: bold;
}

.card a:hover {
    color: #0056b3;
}

/* Admin Card - Specific Styling */
.admin-card {
    background-color: #f8d7da;
    border: 2px solid #f5c2c7;
}

.admin-card .card-icon {
    color: #dc3545;
}

.admin-card:hover {
    background-color: #f1b0b7;
    border-color: #f1b0b7;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-container {
        flex-direction: column;
        align-items: center;
    }

    .card {
        width: 90%;
    }

    h2 {
        font-size: 1.8rem;
    }

    p {
        font-size: 1rem;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <p>What would you like to do today?</p>
        
        <div class="card-container">
            <div class="card">
                <i class="fas fa-book card-icon"></i>
                <h3><a href="book_list.php">Browse Books</a></h3>
            </div>

            <div class="card">
                <i class="fas fa-user card-icon"></i>
                <h3><a href="user_profile.php">My Profile</a></h3>
            </div>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
            <div class="card admin-card">
                <i class="fas fa-cogs card-icon"></i>
                <h3><a href="admin_dashboard.php">Admin Dashboard</a></h3>
            </div>
            <?php } ?>
        </div>
    </div>

    <script>
        // You can add any additional JavaScript here if needed in future
    </script>

    <?php include '../components/footer.php'; ?>
</body>
</html>
