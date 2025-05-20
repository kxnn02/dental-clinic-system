<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $appointment_id = $_POST["appointment_id"];
    $new_status = $_POST["status"];
    $user_role = $_SESSION["user_role"];

    if ($user_role !== "dentist") {
        echo json_encode(["error" => "Unauthorized"]);
        exit();
    }

    // Debugging step: Log received data
    file_put_contents("debug.log", "Updating appointment_id: $appointment_id to status: $new_status\n", FILE_APPEND);

    $query = "UPDATE appointments SET status = ? WHERE appointment_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $new_status, $appointment_id);
    mysqli_stmt_execute($stmt);

    echo json_encode(["success" => "Status updated successfully"]);
}
?>
