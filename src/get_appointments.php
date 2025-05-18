<?php
session_start();
include 'config.php';

$user_id = $_SESSION["user_id"];
$user_role = $_SESSION["user_role"];

if (!$user_id || !$user_role) {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

if ($user_role === "student") {
    // Students see only their appointments
    $query = "SELECT * FROM appointments WHERE student_id = '$user_id'";
} elseif ($user_role === "dentist") {
    // Dentists see only appointments assigned to them
    $query = "SELECT * FROM appointments WHERE dentist_id = '$user_id'";
} elseif ($user_role === "admin") {
    // Admins see all appointments
    $query = "SELECT * FROM appointments";
} else {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$result = mysqli_query($conn, $query);

$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

header("Content-Type: application/json");
echo json_encode($appointments);
?>
