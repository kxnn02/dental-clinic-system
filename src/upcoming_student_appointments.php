<?php
session_start();
include 'config.php';

$user_id = $_SESSION["user_id"];

if (!$user_id) {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

// Fetch upcoming student appointments
$query = "SELECT appointment_id, appointment_date, appointment_time, reason, status
          FROM appointments 
          WHERE student_id = ? AND appointment_date >= CURDATE()
          ORDER BY appointment_date ASC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

header("Content-Type: application/json");
echo json_encode($appointments);
?>
