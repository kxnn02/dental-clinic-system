<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

echo json_encode(["name" => $_SESSION["user_name"]]);
?>
