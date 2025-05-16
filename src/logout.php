<?php
session_start();
session_destroy();
header("Location: ../public/login.html"); // Redirect back to login page
exit();
?>
