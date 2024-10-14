<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'librarian' && $_SESSION['role'] !== 'admin')) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Dashboard - Library Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/librarian_dashboard.css">
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
        <h2>Welcome, Librarian</h2>
        <p>Manage your tasks efficiently with the options below:</p>

        <div class="card-container">
            <div class="card">
                <i class="fas fa-book-reader card-icon"></i>
                <h3><a href="../routes/librarian_routes.php?action=issue_book">Issue Book</a></h3>
            </div>

            <div class="card">
                <i class="fas fa-undo-alt card-icon"></i>
                <h3><a href="../routes/librarian_routes.php?action=return_book">Return Book</a></h3>
            </div>

            <div class="card">
                <i class="fas fa-book card-icon"></i>
                <h3><a href="../routes/librarian_routes.php?action=manage_books">Manage Books</a></h3>
            </div>

            <div class="card">
                <i class="fas fa-plus-circle card-icon"></i>
                <h3><a href="../routes/librarian_routes.php?action=add_book">Add New Book</a></h3>
            </div>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>
</body>
</html>
