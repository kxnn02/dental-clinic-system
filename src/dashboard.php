<?php
session_start(); // Start session

header('Content-Type: application/json'); // Send JSON response

if (!isset($_SESSION['user_name'])) {
    echo json_encode(["error" => "Access denied!"]);
    exit();
}

echo json_encode([
    "name" => $_SESSION['user_name'],
    "email" => $_SESSION['user_email']
]);
?>
