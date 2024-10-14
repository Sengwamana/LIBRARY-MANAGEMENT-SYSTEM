<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - World Mission High School Library Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@700&display=swap" rel="stylesheet">
<style>
    /* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@700&display=swap');

/* Global Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Open Sans', sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f4f4f9;
    padding: 20px;
    margin: 0;
}

h1, h2, h3 {
    font-family: 'Roboto', sans-serif;
}

a {
    text-decoration: none;
    color: #007bff;
    transition: color 0.3s ease;
}

a:hover {
    color: #0056b3;
}

/* Header */
.header {
    background-color: #007bff;
    color: white;
    padding: 20px 0;
}

.header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

.nav a {
    margin-left: 20px;
    font-weight: 600;
    color: white;
}

.nav a.active {
    border-bottom: 2px solid white;
}

.nav a:hover {
    color: #ffd700;
}

/* Main Content */
.container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 20px;
}

.content {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

h2 {
    margin-bottom: 20px;
    font-size: 28px;
    font-weight: bold;
    color: #007bff;
}

h3 {
    margin-top: 20px;
    font-size: 22px;
    color: #333;
}

p {
    margin-bottom: 15px;
    font-size: 16px;
    line-height: 1.8;
}

ul {
    margin-left: 20px;
    list-style-type: disc;
}

ul li {
    margin-bottom: 10px;
}

strong {
    font-weight: bold;
    color: #007bff;
}

/* Footer */
.footer {
    background-color: #333;
    color: white;
    padding: 20px 0;
    text-align: center;
    margin-top: 40px;
}

.footer p {
    margin: 0;
    font-size: 14px;
}

</style>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">World Mission High School Library</h1>
            <nav class="nav">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="privacy.php" class="active">Privacy Policy</a>
            </nav>
        </div>
    </header>

    <main class="container content">
        <h2>Privacy Policy</h2>
        <p>Your privacy is important to us. This privacy policy outlines how we collect, use, and protect your information when you interact with the World Mission High School Library Management System.</p>

        <h3>1. Information We Collect</h3>
        <p>We collect various types of personal information when you interact with the library management system, including:</p>
        <ul>
            <li><strong>Contact Information:</strong> Name, email address, phone number, and postal address when you register for an account or contact us.</li>
            <li><strong>Library Account Information:</strong> Your student ID, library card number, borrowed items, due dates, and overdue fines.</li>
            <li><strong>Usage Data:</strong> Information about how you access and interact with the system (e.g., login times, search history).</li>
            <li><strong>Technical Data:</strong> IP address, browser type, and device information collected automatically through cookies and similar technologies.</li>
        </ul>

        <h3>2. How We Use Your Information</h3>
        <p>We use your information for the following purposes:</p>
        <ul>
            <li>To manage your library account and provide access to library resources.</li>
            <li>To communicate with you regarding library activities, such as book due dates, holds, and fines.</li>
            <li>To enhance and improve our system based on user feedback and interactions.</li>
            <li>To maintain security and prevent unauthorized access to the system.</li>
        </ul>

        <!-- Remaining sections go here... -->

    </main>

    <footer class="footer">
        <?php include '../components/footer.php'; ?>
    </footer>
</body>
</html>
