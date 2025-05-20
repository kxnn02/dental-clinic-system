<?php
session_start();
include 'config.php';

$user_id = $_SESSION["user_id"];
$user_role = $_SESSION["user_role"];

if (!$user_id || !$user_role) {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

if ($user_role === "dentist") {
    // Dentists see only appointments assigned to them with student names
    $query = "SELECT a.appointment_id, a.appointment_date, a.appointment_time, a.reason, 
                     u.name AS student_name, a.status
              FROM appointments a
              LEFT JOIN users u ON a.student_id = u.user_id
              WHERE a.dentist_id = ?";
}

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

header("Content-Type: application/json");
echo json_encode($appointments);
?>
