<?php 
// sidebar.php
?>
<script>
    // Ensure DOM is fully loaded before running this script
document.addEventListener('DOMContentLoaded', function () {
    const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
    const sidebar = document.querySelector('.sidebar');

    // Check if both elements exist
    if (toggleSidebarBtn && sidebar) {
        toggleSidebarBtn.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    } else {
        console.error('Sidebar or toggle button not found!');
    }
});

</script>
<style>
    /* Sidebar Styles */
.sidebar {
    width: 250px;
    height: 100%;
    background-color: #333;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    box-shadow: 2px 0 12px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out; /* Smooth slide effect */
    z-index: 999; /* Ensure it sits above other elements */
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-250px); /* Initially hidden off-screen */
        width: 200px; /* Adjusted for mobile */
    }

    .sidebar.active {
        transform: translateX(0); /* Slide-in on toggle */
    }

    .toggle-sidebar-btn {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #222;
        color: white;
        padding: 10px;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .toggle-sidebar-btn:hover {
        background-color: #555;
        transform: rotate(90deg);
    }
}

    /* Sidebar Styles */
.sidebar {
    width: 250px;
    height: 100%;
    background-color: #333;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    box-shadow: 2px 0 12px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out;
    z-index: 999;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 20px;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: background-color 0.3s ease, transform 0.3s ease;
    padding: 10px 15px;
    border-radius: 5px;
}

.sidebar ul li a:hover {
    background-color: #007bff;
    transform: translateX(5px);
}

.sidebar ul li a i {
    font-size: 20px;
}

/* Mobile Styles */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-250px);
        width: 200px;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .toggle-sidebar-btn {
        display: block;
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #222;
        color: white;
        padding: 10px;
        border-radius: 5px;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .toggle-sidebar-btn:hover {
        background-color: #555;
        transform: rotate(90deg);
    }
}

</style>
<nav class="sidebar" id="sidebar">
    <ul>
        <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="book_list.php"><i class="fas fa-book"></i> Books</a></li>
        <li><a href="user_profile.php"><i class="fas fa-user"></i> Profile</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
            <li><a href="admin_dashboard.php"><i class="fas fa-user-shield"></i> Admin Dashboard</a></li>
        <?php } ?>
    </ul>
</nav>

<script>
    // Move to main.js
    const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');
    const sidebar = document.querySelector('.sidebar');

    toggleSidebarBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
</script>
