<?php
session_start();
include 'config.php';

// Ensure user is logged in
if (!isset($_SESSION["user_id"])) {
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch appointments for the logged-in user
$query = "SELECT appointment_id, appointment_date, appointment_time, reason, status FROM appointments WHERE student_id = '$user_id' ORDER BY appointment_date ASC";
$result = mysqli_query($conn, $query);

$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

// Return appointments as JSON
header("Content-Type: application/json");
echo json_encode($appointments);
exit();
?>
