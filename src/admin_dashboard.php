<?php
session_start();
include 'config.php';

// Ensure user is logged in as an admin
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "admin") {
    header("Location: ../public/login.html");
    exit();
}
?>
