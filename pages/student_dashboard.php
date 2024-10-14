<?php
// student_dashboard.php
session_start();

// Access control for students, admins, and librarians
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'student' && $_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'librarian')) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Library Management</title>
    <link rel="stylesheet" href="../assets/css/student_dashboard.css">
    <style>
        /* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 20px;
    text-align: center;
}

p {
    font-size: 1.125rem;
    color: #555;
}

/* Dashboard Cards */
.dashboard-links {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.dashboard-card {
    background-color: #007bff;
    color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-decoration: none;
}

.dashboard-card i {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.dashboard-card h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.dashboard-card p {
    font-size: 1rem;
    margin: 0;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-links {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .container {
        padding: 15px;
    }

    h2 {
        font-size: 2rem;
    }

    .dashboard-card {
        padding: 20px;
    }
}

    </style>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>📚 Student Dashboard</h2>
        <p>Welcome to your student dashboard! What would you like to do today?</p>

        <div class="dashboard-links">
            <a href="../routes/student_routes.php?action=view_books" class="dashboard-card">
                <i class="fas fa-book"></i>
                <h3>View Available Books</h3>
                <p>Browse through all the books currently available in the library.</p>
            </a>

            <a href="../routes/student_routes.php?action=view_issued_books" class="dashboard-card">
                <i class="fas fa-clipboard-list"></i>
                <h3>View Issued Books</h3>
                <p>Check the books you have borrowed from the library.</p>
            </a>

            <a href="../routes/student_routes.php?action=profile" class="dashboard-card">
                <i class="fas fa-user-circle"></i>
                <h3>Your Profile</h3>
                <p>Manage your profile details and update your information.</p>
            </a>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
