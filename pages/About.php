<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - World Mission High School Library Management System</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
/* Root Variables */
:root {
    --primary-color: #3498DB; /* Light blue */
    --secondary-color: #1ABC9C; /* Light green */
    --accent-color: #2980B9; /* Darker blue */
    --text-color: #333;
    --header-background: #3498DB; /* Light blue for the header */
    --footer-background: #2980B9; /* Darker blue for the footer */
    --font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    --light-background: #f4f4f4;
    --shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Global Styles */
body {
    font-family: var(--font-family);
    line-height: 1.6;
    background-color: var(--light-background);
    color: var(--text-color);
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

h1, h2, h3 {
    margin-bottom: 20px;
}

p, ul {
    margin-bottom: 20px;
}

/* Animations */
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    0% { opacity: 0; transform: translateX(-50px); }
    100% { opacity: 1; transform: translateX(0); }
}

/* Header Styles */
header {
    background-color: var(--header-background);
    padding: 20px 0;
    color: #fff;
    box-shadow: var(--shadow);
    animation: fadeIn 1s ease-in-out;
}

header h1 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

nav {
    text-align: center;
    margin-top: 10px;
    animation: slideIn 1.5s ease-in-out;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 15px;
    padding: 10px 20px;
    transition: background-color 0.3s ease;
    font-size: 1.1rem;
}

nav a:hover, nav a.active {
    background-color: var(--secondary-color);
    border-radius: 5px;
}

/* About Section */
.about-section {
    background-color: #fff;
    padding: 60px 20px;
    border-radius: 10px;
    box-shadow: var(--shadow);
    margin-top: 30px;
    animation: fadeIn 2s ease-in-out;
}

.about-section h2 {
    font-size: 2rem;
    color: var(--primary-color);
    text-align: center;
    animation: slideIn 1.5s ease-in-out;
}

.about-section h3 {
    font-size: 1.8rem;
    color: var(--accent-color);
    margin-bottom: 15px;
    animation: slideIn 1.5s ease-in-out;
}

.about-section p, .about-section ul {
    font-size: 1.1rem;
    margin-bottom: 20px;
    line-height: 1.8;
    animation: fadeIn 2s ease-in-out;
}

.about-section ul {
    list-style-type: none;
    padding-left: 0;
}

.about-section ul li {
    padding-left: 1.5rem;
    position: relative;
    font-size: 1.1rem;
}

.about-section ul li::before {
    content: '✔️';
    position: absolute;
    left: 0;
    top: 0;
    color: var(--secondary-color);
    font-size: 1rem;
}

/* Footer Styles */
footer {
    background-color: var(--footer-background);
    color: #fff;
    padding: 20px 0;
    text-align: center;
    margin-top: 30px;
    box-shadow: var(--shadow);
    animation: fadeIn 1.5s ease-in-out;
}

footer p {
    margin: 0;
    font-size: 1rem;
}

/* Hover Effects */
.about-section section:hover {
    background-color: #e3f2fd; /* Lighter blue hover effect */
    transition: background-color 0.3s ease;
}

/* Media Queries for Responsive Design */
@media (max-width: 768px) {
    header h1 {
        font-size: 2rem;
    }

    nav a {
        font-size: 1rem;
        margin: 0 10px;
        padding: 8px 15px;
    }

    .about-section h2, .about-section h3 {
        font-size: 1.5rem;
    }

    .about-section p, .about-section ul li {
        font-size: 1rem;
    }

    footer p {
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    header h1 {
        font-size: 1.8rem;
    }

    nav a {
        font-size: 0.9rem;
        margin: 0 8px;
        padding: 5px 10px;
    }

    .about-section h2 {
        font-size: 1.4rem;
    }

    .about-section h3 {
        font-size: 1.2rem;
    }

    .about-section p, .about-section ul li {
        font-size: 0.9rem;
    }

    footer p {
        font-size: 0.8rem;
    }
}
</style>


</head>
<body>
    <main>
        <div class="container about-section">
            <h2>About Us</h2>
            <p>Welcome to the <strong>World Mission High School Library Management System</strong>. Our platform is dedicated to providing seamless and efficient library services to support academic excellence.</p>

            <!-- Tabs Section -->
            <div class="tab-container">
                <div class="tabs">
                    <button class="tab-link active" onclick="openTab(event, 'vision')">Vision & Mission</button>
                    <button class="tab-link" onclick="openTab(event, 'features')">Features</button>
                    <button class="tab-link" onclick="openTab(event, 'benefits')">Benefits</button>
                    <button class="tab-link" onclick="openTab(event, 'future')">Future Developments</button>
                    <button class="tab-link" onclick="openTab(event, 'commitment')">Commitment</button>
                </div>

                <!-- Tab Contents -->
                <div id="vision" class="tab-content active-tab">
                    <h3>Our Vision and Mission</h3>
                    <p>Our vision is to build a world where every student, educator, and missionary has easy access to the resources they need...</p>
                </div>

                <div id="features" class="tab-content">
                    <h3>Features of Our Library Management System</h3>
                    <ul>
                        <li><i class="fas fa-book"></i> <strong>Catalog Management:</strong> Comprehensive system for tracking books and resources.</li>
                        <li><i class="fas fa-search"></i> <strong>User-Friendly Interface:</strong> Intuitive search and reservation system.</li>
                        <li><i class="fas fa-bell"></i> <strong>Automated Notifications:</strong> Alerts for due dates and overdue books.</li>
                        <li><i class="fas fa-digital-tachograph"></i> <strong>Digital Resources:</strong> Seamless access to e-books and databases.</li>
                        <li><i class="fas fa-chart-line"></i> <strong>Advanced Reporting:</strong> Data on usage, borrowing trends, and more.</li>
                        <li><i class="fas fa-users-cog"></i> <strong>Role-Based Access:</strong> Security through role-based access control.</li>
                    </ul>
                </div>

                <div id="benefits" class="tab-content">
                    <h3>How It Benefits Users</h3>
                    <ul>
                        <li><i class="fas fa-user-graduate"></i> <strong>For Students:</strong> Quick access to resources, both physical and digital.</li>
                        <li><i class="fas fa-user-tie"></i> <strong>For Librarians:</strong> Simplified processes for cataloging and managing resources.</li>
                        <li><i class="fas fa-chalkboard-teacher"></i> <strong>For Educators:</strong> Access to teaching materials and research resources.</li>
                    </ul>
                </div>

                <div id="future" class="tab-content">
                    <h3>Future Developments</h3>
                    <p>We plan to integrate more global digital libraries, improve search algorithms, and introduce mobile app support for on-the-go access.</p>
                </div>

                <div id="commitment" class="tab-content">
                    <h3>Our Commitment to Education</h3>
                    <p>At World Mission High School, we believe education is key to unlocking potential. By providing access to knowledge...</p>
                </div>
            </div>
        </div>
    </main>
    <?php include '../components/footer.php'; ?>

    <script>
        function openTab(evt, tabName) {
    // Hide all tab content
    let tabContent = document.querySelectorAll(".tab-content");
    tabContent.forEach(content => content.style.display = "none");

    // Remove active class from all tab links
    let tabLinks = document.querySelectorAll(".tab-link");
    tabLinks.forEach(link => link.classList.remove("active"));

    // Show the clicked tab content
    document.getElementById(tabName).style.display = "block";

    // Add the active class to the clicked tab button
    evt.currentTarget.classList.add("active");
}

// Initialize the first tab as active
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".tab-content").style.display = "block";
});

    </script>
</body>
</html>
