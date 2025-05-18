<?php
session_start();
include 'config.php';

// Ensure user is logged in as a student
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "student") {
    header("Location: ../public/login.html");
    exit();
}
?>
