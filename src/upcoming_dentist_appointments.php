<?php
session_start();
include 'config.php';

$user_id = $_SESSION["user_id"];

if (!$user_id) {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

// Fetch upcoming dentist appointments (EXCLUDING Approved ones)
$query = "SELECT a.appointment_id, a.appointment_date, a.appointment_time, a.reason, 
                 u.name AS student_name, a.status
          FROM appointments a
          LEFT JOIN users u ON a.student_id = u.user_id
          WHERE a.dentist_id = ? 
          AND a.appointment_date >= CURDATE() 
          AND a.status IN ('Pending', 'Canceled') -- Excludes Approved
          ORDER BY a.appointment_date ASC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);

header("Content-Type: application/json");
echo json_encode($appointments);
?>
