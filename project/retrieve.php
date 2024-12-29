<?php
$servername = "localhost";
$username = "root";
$password = "123456";  // Update with your MySQL password
$dbname = "campus_lost_and_found";  // Your database name

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $contact_info = $_POST['contact_info'];
    $type = $_POST['type']; // Assume this is a dropdown in your form to select "lost" or "found"

    // Prepare SQL based on item type
    if ($type == "lost") {
        $sql = "INSERT INTO lost_items (item_name, description, location, date_lost, contact_info) VALUES (?, ?, ?, ?, ?)";
    } else {
        $sql = "INSERT INTO found_items (item_name, description, location, date_found, contact_info) VALUES (?, ?, ?, ?, ?)";
    }

    // Prepare and bind statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $item_name, $description, $location, $date, $contact_info);

    // Execute and check
    if ($stmt->execute()) {
        echo "Record submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->cl
