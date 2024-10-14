<?php
// index.php
session_start();
header("Location: pages/home.php");
// Include the autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Now, classes like Book, User, etc., can be used without explicitly including their files.
$book = new Book();  // Automatically loads /models/Book.php
$user = new User();  // Automatically loads /models/User.php
?>