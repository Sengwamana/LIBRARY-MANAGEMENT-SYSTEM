<?php
// footer.php
?>
<footer>
    <style>
/* Footer Styles */
footer {
    background-color: #222;
    color: #fff;
    padding: 40px 20px;
    text-align: center;
    font-size: 1rem;
    animation: fadeInUp 1s ease-in-out; /* Fade-in animation */
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-container p {
    margin: 0 0 15px;
    font-size: 1.1rem;
    color: #ccc;
    opacity: 0;
    animation: fadeIn 1s ease-in forwards; /* Fade-in text */
    animation-delay: 0.5s; /* Delay to match overall footer appearance */
}

.footer-container p:first-child {
    font-weight: bold;
    animation-delay: 0.7s; /* Slightly delayed animation for copyright text */
}

.footer-nav {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
    padding: 0;
}

.footer-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 25px;
    opacity: 0;
    animation: fadeIn 1s ease-in forwards; /* Fade-in for links */
    animation-delay: 1s; /* Delay for the link animations */
}

.footer-nav ul li a {
    color: #ddd;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 30px;
    border: 2px solid #ddd;
    transition: background-color 0.4s ease, color 0.4s ease, transform 0.4s ease; /* Smooth transitions */
    opacity: 0;
    animation: fadeInUp 1s ease-in forwards; /* Slide-up effect for links */
    animation-delay: 1.2s; /* Delayed to match overall content */
}

.footer-nav ul li a:hover {
    background-color: #fff;
    color: #222;
    transform: translateY(-5px); /* Lift link on hover */
}

.footer-container p:last-child {
    margin-top: 20px;
    font-size: 0.95rem;
    color: #bbb;
    animation-delay: 1.5s; /* Delay to make everything flow */
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px); /* Start from below */
    }
    to {
        opacity: 1;
        transform: translateY(0); /* End at original position */
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-nav ul {
        flex-direction: column;
        gap: 15px;
    }

    .footer-nav ul li a {
        padding: 10px 20px;
    }
}

    </style>
    <div class="footer-container">
        <p>&copy; <?php echo date('Y'); ?> Library Management System. All Rights Reserved.</p>
        <p><b><i>Designed by Emeran Tech</i></b></p>
        <br>
        <nav class="footer-nav">
            <ul>
                <li><a href="../pages/home.php">Home</a></li>
                <li><a href="../pages/About.php">About</a></li>
                <li><a href="../pages/Contact.php">Contact</a></li>
                <li><a href="../pages/PrivacyPolicy.php">Privacy Policy</a></li>
            </ul>
        </nav>
    </div>
</footer>
