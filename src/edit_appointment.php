<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $appointment_id = $_POST["appointment_id"];
    $new_date = $_POST["appointment_date"];
    $new_time = $_POST["appointment_time"];
    $new_reason = $_POST["reason"];

    $update_query = "UPDATE appointments 
                     SET appointment_date = '$new_date', appointment_time = '$new_time', reason = '$new_reason'
                     WHERE id = '$appointment_id' AND student_id = '{$_SESSION["user_id"]}'";

    if (mysqli_query($conn, $update_query)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
}
?>
