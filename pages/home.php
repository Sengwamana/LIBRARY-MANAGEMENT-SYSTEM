<?php
// home.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Library Management System</title>
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.7;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Slideshow Styles */
        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: 40px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .mySlides {
            display: none;
            animation: fade 1.5s ease-in-out;
        }

        @keyframes fade {
            from { opacity: 0.5; }
            to { opacity: 1; }
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            user-select: none;
            transition: 0.6s ease;
        }

        .next {
            right: 0;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        .dot-container {
            text-align: center;
            padding: 10px 0;
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        .caption {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 10px;
            border-radius: 8px;
        }

        /* Welcome Section */
        .welcome {
            padding: 30px;
            text-align: center;
            background-color: #f4f4f4;
            border-radius: 8px;
            margin-top: 30px;
        }

        .welcome h2 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        .welcome p {
            font-size: 1.2rem;
            color: #555;
        }

        .user-actions {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .user-actions li {
            display: inline-block;
            margin: 0 10px;
        }

        .user-actions a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s ease;
        }

        .user-actions a:hover {
            background-color: #0056b3;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .welcome {
                padding: 15px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
        <?php include '../components/header.php'; ?>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- Main Content -->
    <div class="main-content">
        <!-- Slideshow Section -->
        <section class="slideshow-container">
            <div class="mySlides">
                <img src="../assets/images/LMS.png" style="width:100%; height:auto; object-fit:cover;">
                <div class="caption">Welcome to World Mission High School</div>
            </div>

            <div class="mySlides">
                <img src="../assets/images/LMS1.png" style="width:100%; height:auto; object-fit:cover;">
                <div class="caption">Caption for Slide 2</div>
            </div>

            <div class="mySlides">
                <img src="../assets/images/LMS2.png" style="width:100%; height:auto; object-fit:cover;">
                <div class="caption">Caption for Slide 3</div>
            </div>

            <div class="mySlides">
                <img src="../assets/images/LMS4.png" style="width:100%; height:auto; object-fit:cover;">
                <div class="caption">Caption for Slide 4</div>
            </div>

            <div class="mySlides">
                <img src="../assets/images/LMS5.png" style="width:100%; height:auto; object-fit:cover;">
                <div class="caption">Caption for Slide 5</div>
            </div>

            <div class="mySlides">
                <img src="../assets/images/Emeran_Tech_logo.png" style="width:100%; height:auto; object-fit:cover;">
                <div class="caption">Emeran Tech</div>
            </div>

            <!-- Next and Previous Buttons -->
            <a class="prev" onclick="prevSlide()">&#10094;</a>
            <a class="next" onclick="nextSlide()">&#10095;</a>
        </section>

        <!-- Dots for Navigation -->
        <div class="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
            <span class="dot" onclick="currentSlide(6)"></span>
        </div>

        <!-- Welcome Section -->
        <section class="welcome">
            <h2>Welcome to the Library Management System</h2>
            <p>This system allows users to manage books, view their profile, and issue or return books.</p>

            <!-- Navigation based on login status -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <p>Hello, <?php echo htmlspecialchars($_SESSION['role']); ?>! You are logged in.</p>
                <ul class="user-actions">
                    <li><a href="dashboard.php" class="btn">Go to Dashboard</a></li>
                    <li><a href="../controllers/auth_controller.php?logout=true" class="btn btn-secondary">Logout</a></li>
                </ul>
            <?php else: ?>
                <p>Please <a href="login.php">log in</a> or <a href="register.php">register</a> to access the system.</p>
            <?php endif; ?>
        </section>
    </div>
        <?php include '../components/footer.php'; ?>

    <!-- Slideshow JavaScript -->
     <script src="../assets/js/slideshow.js"></script>
    <script>
        let slideIndex = 0;
        showSlides(slideIndex);

        function showSlides(n) {
            let i;
            const slides = document.getElementsByClassName("mySlides");
            const dots = document.getElementsByClassName("dot");
            if (n >= slides.length) { slideIndex = 0; }
            if (n < 0) { slideIndex = slides.length - 1; }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex].style.display = "block";
            dots[slideIndex].className += " active";
        }

        function nextSlide() {
            showSlides(++slideIndex);
        }

        function prevSlide() {
            showSlides(--slideIndex);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n - 1);
        }
    </script>
</body>
</html>
