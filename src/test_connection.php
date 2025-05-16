<?php
include 'config.php'; // Include the database connection

if ($conn) {
    echo "✅ Database connection successful!";
} else {
    echo "❌ Connection failed: " . mysqli_connect_error();
}
?>
