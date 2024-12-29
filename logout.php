<?php
session_start();
session_destroy(); // Destroy the session to log the user out
header("Location: admin-login.html"); // Redirect back to login page
exit();
?>
