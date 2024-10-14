<?php
require_once '../middleware/auth_middleware.php';
require_once '../middleware/admin_middleware.php';
checkAuth();
checkAdmin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Library Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin_dashboard.css">
    <style>
        /* Reset Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body & Container */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    min-height: 100vh;
}

h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #007bff;
    text-align: center;
}

p {
    font-size: 1.1rem;
    margin-bottom: 20px;
    text-align: center;
    color: #555;
}

/* Dashboard Container */
.dashboard-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Card Container */
.card-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 40px;
}

/* Individual Dashboard Card */
.dashboard-card {
    background-color: #007bff;
    color: white;
    width: 300px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 123, 255, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.dashboard-card i {
    margin-bottom: 15px;
}

.dashboard-card h3 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.dashboard-card p {
    font-size: 1rem;
    margin-bottom: 20px;
    color: #eaeaea;
    text-align: center;
}

/* Button Styles */
.btn {
    background-color: white;
    color: #007bff;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
    transform: translateY(-5px);
}

/* Card Hover Effect */
.dashboard-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .card-container {
        flex-direction: column;
        align-items: center;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <p>Welcome, admin! Manage the library resources below:</p>

        <!-- Dashboard Cards -->
        <div class="card-container">
            <div class="dashboard-card">
                <i class="fas fa-book fa-3x"></i>
                <h3>Manage Books</h3>
                <p>View, add, update, or delete books in the library collection.</p>
                <a href="book_list.php" class="btn">Go to Books</a>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-users fa-3x"></i>
                <h3>Manage Users</h3>
                <p>View, add, or manage user accounts and permissions.</p>
                <a href="../routes/admin_routes.php?action=manage_users" class="btn">Go to Users</a>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-chart-bar fa-3x"></i>
                <h3>View Reports</h3>
                <p>Generate reports on books, users, and library activity.</p>
                <a href="reports.php" class="btn">Go to Reports</a>
            </div>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
