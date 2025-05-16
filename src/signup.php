<?php
include 'config.php'; // Connect to MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password

    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ../public/login.html");
    } else {
        echo "❌ Signup failed: " . mysqli_error($conn);
    }
}
?>
