<?php
// admin_middleware.php
require_once '../config/config.php';
session_start();

function checkAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        header("Location: " . BASE_URL . "pages/dashboard.php");
        exit();
    }
}
?>
