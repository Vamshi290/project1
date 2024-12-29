<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not, redirect to the login page
    header("Location: admin-login.html");
    exit();
}

echo "<h1>Welcome, " . $_SESSION['user'] . "!</h1>";
echo "<p>Here are the options available to you:</p>";

// You can add more options here, such as links to manage items, view reports, etc.
?>

<p><a href="logout.php">Logout</a></p>
