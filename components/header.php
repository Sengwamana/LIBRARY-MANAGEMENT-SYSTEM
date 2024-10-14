<?php
// header.php
require_once '../config/config.php';
require '../components/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>World Mission High School Library Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dark Mode Toggle
            const toggleDarkModeBtn = document.querySelector('.toggle-dark-mode-btn');
            if (toggleDarkModeBtn) {
                toggleDarkModeBtn.addEventListener('click', () => {
                    document.body.classList.toggle('dark-mode');
                    const isDarkMode = document.body.classList.contains('dark-mode');
                    localStorage.setItem('darkMode', isDarkMode);
                });

                // Check if dark mode is enabled on page load
                const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
                if (darkModeEnabled) {
                    document.body.classList.add('dark-mode');
                }
            }

            // Sidebar Toggle
            const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
            const sidebar = document.querySelector('.sidebar');
            if (toggleSidebarBtn && sidebar) {
                toggleSidebarBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                });

                // Close sidebar when clicking outside of it (optional for better UX)
                document.addEventListener('click', (event) => {
                    if (!sidebar.contains(event.target) && !toggleSidebarBtn.contains(event.target) && sidebar.classList.contains('active')) {
                        sidebar.classList.remove('active');
                    }
                });

                // Prevent closing when clicking inside the sidebar
                sidebar.addEventListener('click', (event) => {
                    event.stopPropagation();
                });
            }
        });
    </script>
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Roboto', 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.7;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* CSS Variables */
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --dark-bg: #222;
            --white-color: #fff;
            --gradient-bg: linear-gradient(90deg, #007bff, #6610f2);
            --footer-bg: #2b5876;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --hover-color: #0056b3;
            --hover-secondary: #5a6268;
            --spacing: 1.5rem;
            --header-height: 80px;
        }

        /* Header Styles */
        header {
            background: var(--gradient-bg);
            color: var(--white-color);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px var(--shadow-color);
            transition: background-color 0.3s ease;
            animation: fadeInDown 0.5s ease-in-out;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        h1 {
            font-size: 2rem;
            color: white;
            animation: fadeIn 1s ease-in forwards;
        }

        h1 span {
            display: block;
        }

        header img {
            width: 50px;
            border-radius: 50%;
            margin-left: 15px;
            animation: fadeIn 1.5s ease-in forwards;
            animation-delay: 0.5s;
        }

        /* Dark Mode Toggle Button */
        .toggle-dark-mode-btn {
            background-color: #222;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 15px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .toggle-dark-mode-btn:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        /* Main Navigation */
        .main-nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            padding: 0;
            animation: fadeIn 1.2s ease-in forwards;
            animation-delay: 1s;
        }

        .main-nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .main-nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #222;
            position: fixed;
            top: 0;
            left: -250px;
            transition: left 0.3s ease;
            overflow-y: auto;
            padding-top: 20px;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
            text-align: center;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #555;
        }

        /* Toggle Sidebar Button */
        .toggle-sidebar-btn {
            background-color: #222;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            border: none;
            display: block; /* Visible by default */
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .toggle-sidebar-btn:hover {
            background-color: #555;
            transform: rotate(90deg);
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: var(--dark-bg);
            color: #eaeaea;
        }

        body.dark-mode header {
            background-color: #333;
            color: #eaeaea;
        }

        body.dark-mode .main-nav ul li a {
            color: #eaeaea;
        }

        body.dark-mode .toggle-dark-mode-btn {
            background-color: #f4f4f4;
            color: #333;
        }

        /* Responsive Design for Sidebar and Header */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
            }

            header img {
                margin: 15px auto;
            }

            .main-nav ul {
                display: none;
                flex-direction: column;
                gap: 10px;
                position: absolute;
                top: var(--header-height);
                left: 0;
                width: 100%;
                background-color: #007bff;
                padding: 20px 0;
                border-radius: 0 0 10px 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .main-nav ul.active {
                display: flex;
            }

            .toggle-sidebar-btn {
                display: block;
                position: absolute;
                top: 20px;
                left: 20px;
            }

            .toggle-dark-mode-btn {
                margin: 10px auto;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <header>
        <!-- Dark Mode Toggle Button -->
        <button class="toggle-dark-mode-btn" aria-label="Toggle Dark Mode">🌙 Toggle Dark Mode</button>

        <div class="header-container">
            <h1>
                <span style="color: #ffff;">World Mission High School</span>
                <img src="../assets/images/logo1.png" alt="World Mission High School Library Management System Logo">
                <span style="color: red;">Management System</span>
            </h1>

            <nav class="main-nav">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="book_list.php">Books</a></li>
                    <li><a href="user_profile.php">Profile</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>

            <!-- Toggle Sidebar Button -->
            <button class="toggle-sidebar-btn" aria-label="Toggle Sidebar" aria-controls="sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Sidebar Component (imported via sidebar.php) -->
    <div class="sidebar">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Books</a></li>
            <li><a href="#">Members</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>
</body>
</html>
