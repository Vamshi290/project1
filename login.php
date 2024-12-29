<?php
// Database connection parameters
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Prepare and execute SQL query to get the user data
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the username exists and password matches
    if ($result->num_rows > 0 && password_verify($pass, $row['password'])) {
        // Successful login
        session_start();
        $_SESSION['user'] = $user; // Store the username in the session
        header("Location: admin-options.php"); // Redirect to the admin options page
        exit(); // Always use exit() after header redirection
    } else {
        // Invalid login credentials
        echo "<script>alert('Incorrect username or password.'); window.location.href='admin-login.html';</script>";
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
