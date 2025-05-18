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
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_role"] = $user["role"];

            // Redirect based on role
            if ($user["role"] === "student") {
                header("Location: ../public/student_dashboard.html");
            } elseif ($user["role"] === "dentist") {
                header("Location: ../public/dentist_dashboard.html");
            } elseif ($user["role"] === "admin") {
                header("Location: ../public/admin_dashboard.html");
            } else {
                header("Location: ../public/login.html?error=invalid_role");
            }
            exit();
        } else {
            header("Location: ../public/login.html?error=1"); // Incorrect password
            exit();
        }
    } else {
        header("Location: ../public/login.html?error=2"); // Email not found
        exit();
    }
}
?>
