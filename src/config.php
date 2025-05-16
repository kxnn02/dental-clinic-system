<?php
$server = "localhost";  // Your database server (local for now)
$username = "root";  // Default username in XAMPP
$password = "";  // No password by default
$database = "dental_clinic_db";  // Your database name

// Create connection
$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// If everything is OK, this file allows PHP to access the database.
?>
