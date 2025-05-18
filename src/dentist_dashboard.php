<?php
session_start();
include 'config.php';

// Ensure user is logged in as a dentist
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] !== "dentist") {
    header("Location: ../public/login.html");
    exit();
}
?>
