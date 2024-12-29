<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "track";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert admin with a hashed password
$admin_username = "admin"; // Replace with desired admin username
$admin_password = "admin123"; // Replace with desired admin password
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (username, password) VALUES ('$admin_username', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "New admin record created successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
