<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $appointment_id = $_POST["appointment_id"];
    $new_status = $_POST["status"];
    $user_role = $_SESSION["user_role"];

    if ($user_role !== "dentist") {
        header("Location: ../public/dentist_dashboard.html?error=unauthorized");
        exit();
    }

    $query = "UPDATE appointments SET status = ? WHERE appointment_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $new_status, $appointment_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../public/upcoming_dentist_appointments.html?success=updated");
        exit();
    } else {
        header("Location: ../public/upcoming_dentist_appointments.html?error=update_failed");
        exit();
    }
}
?>
