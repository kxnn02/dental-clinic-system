<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_SESSION["user_id"]; // Assuming users are logged in
    $dentist_id = $_POST["dentist_id"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];
    $reason = $_POST["reason"]; // New field

    // Check if the selected time slot is available
    $check_query = "SELECT * FROM appointments WHERE dentist_id = '$dentist_id' AND appointment_date = '$appointment_date' AND appointment_time = '$appointment_time'";
    $check_result = mysqli_query($conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        // Time slot is already booked
        header("Location: ../public/booking.html?error=unavailable");
        exit();
    } else {
        // Insert new appointment into database
        $insert_query = "INSERT INTO appointments (student_id, dentist_id, appointment_date, appointment_time, reason, status) 
                         VALUES ('$student_id', '$dentist_id', '$appointment_date', '$appointment_time', '$reason', 'pending')";

        if (mysqli_query($conn, $insert_query)) {
            header("Location: ../public/dashboard.html?success=booked");
            exit();
        } else {
            header("Location: ../public/booking.html?error=failed");
            exit();
        }
    }
}
?>
