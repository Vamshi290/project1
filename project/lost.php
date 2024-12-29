<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found Items</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #A9A9A9; /* Light grey background */
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .item-container {
            border: 1px solid #ccc; /* Light grey border */
            margin: 10px;
            padding: 10px;
            width: 200px;
            box-sizing: border-box;
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .item-container img {
            max-width: 100%; /* Responsive image */
            height: auto;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .buttons a {
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin: 0 5px;
            display: inline-block;
        }
        .buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">

<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "123456";
$database = "campus_lost_and_found";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data from the table
$sql = "SELECT * FROM lost_found_items WHERE checked = 1";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="item-container">';
        echo "<strong>ID:</strong> " . htmlspecialchars($row["id"]) . "<br>";
        echo "<strong>Item Name:</strong> " . htmlspecialchars($row["item_name"]) . "<br>";
        echo "<strong>Description:</strong> " . htmlspecialchars($row["description"]) . "<br>";
        echo "<strong>Status:</strong> " . htmlspecialchars($row["status"]) . "<br>";
        if (!empty($row["photo"])) {
            echo "<img src='" . htmlspecialchars($row["photo"]) . "' alt='Item Photo'><br>";
        } else {
            echo "<em>No photo available</em><br>";
        }
        echo '</div>';
    }
} else {
    echo "<p>No lost items found.</p>";
}

// Close connection
$conn->close();
?>

</div>

<div class="buttons">
    <a href="http://localhost/project/lost.php">Lost Items</a>
    <a href="http://localhost/project/found.php">Found Items</a>
</div>

</body>
</html>
