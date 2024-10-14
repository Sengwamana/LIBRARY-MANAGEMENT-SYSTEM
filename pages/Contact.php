<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - World Mission High School Library Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>World Mission High School Library Management System</h1>
        </div>
    </header>

    <div class="container">
        <h2>Contact Us</h2>
        <p>If you have any questions, feel free to reach out to us using the form below.</p>

        <form action="submit_contact.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <footer>
        <?php include '../components/footer.php'; ?>
    </footer>
</body>
</html>
