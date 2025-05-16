<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $appointment_id = $_POST["appointment_id"];

    $delete_query = "DELETE FROM appointments WHERE id = '$appointment_id' AND student_id = '{$_SESSION["user_id"]}'";

    if (mysqli_query($conn, $delete_query)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }
}
?>
