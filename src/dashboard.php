<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.html"); // Redirect if not logged in
    exit();
}

// Send user data as JSON response
header("Content-Type: application/json");
echo json_encode([
    "user_name" => $_SESSION["user_name"],
    "user_email" => $_SESSION["user_email"]
]);
exit();
?>
