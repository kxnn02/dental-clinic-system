<?php
include 'config.php';

$query = "SELECT user_id AS dentist_id, name FROM users WHERE role = 'dentist'";
$result = mysqli_query($conn, $query);

$dentists = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dentists[] = $row;
}

header("Content-Type: application/json");
echo json_encode($dentists);
?>
