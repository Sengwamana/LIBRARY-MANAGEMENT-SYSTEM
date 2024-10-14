<?php
require_once '../config/config.php';
session_start();

function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "pages/login.php");
        exit();
    }
}
?>
