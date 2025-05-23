<?php
session_start();
include 'config.php';

$user_id = $_SESSION["user_id"];
$user_role = $_SESSION["user_role"];

if ($user_role !== "dentist") {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

// Fetch total patients seen by the dentist this month
$queryTotalPatients = "SELECT COUNT(*) AS total FROM appointments WHERE dentist_id = ? AND status = 'Completed' AND MONTH(appointment_date) = MONTH(CURDATE())";
$stmtTotal = mysqli_prepare($conn, $queryTotalPatients);
mysqli_stmt_bind_param($stmtTotal, "i", $user_id);
mysqli_stmt_execute($stmtTotal);
$resultTotal = mysqli_stmt_get_result($stmtTotal);
$totalPatients = mysqli_fetch_assoc($resultTotal)["total"];

// Fetch upcoming appointments for the dentist
$queryUpcoming = "SELECT COUNT(*) AS upcoming FROM appointments WHERE dentist_id = ? AND appointment_date >= CURDATE()";
$stmtUpcoming = mysqli_prepare($conn, $queryUpcoming);
mysqli_stmt_bind_param($stmtUpcoming, "i", $user_id);
mysqli_stmt_execute($stmtUpcoming);
$resultUpcoming = mysqli_stmt_get_result($stmtUpcoming);
$upcomingAppointments = mysqli_fetch_assoc($resultUpcoming)["upcoming"];

echo json_encode(["total_patients" => $totalPatients, "upcoming_appointments" => $upcomingAppointments]);
?>
