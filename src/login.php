<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_email"] = $user["email"];
            header("Location: ../public/dashboard.html");
            exit();
        } else {
            header("Location: ../public/login.html");
            exit();
        }
    } else {
        header("Location: ../public/login.html");
        exit();
    }
}
?>
