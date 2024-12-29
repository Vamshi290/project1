<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "123456"; // Replace with your MySQL password
$dbname = "campus_lost_and_found"; // Replace with your database name

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
    $type = mysqli_real_escape_string($conn, $_POST['type']); // 'lost' or 'found'

    // Prepare SQL statement based on the type
    if ($type == 'lost') {
        $sql = "INSERT INTO lost_items (item_name, description, location, date, contact_info) 
                VALUES ('$item_name', '$description', '$location', '$date', '$contact_info')";
    } else if ($type == 'found') {
        $sql = "INSERT INTO found_items (item_name, description, location, date, contact_info) 
                VALUES ('$item_name', '$description', '$location', '$date', '$contact_info')";
    }

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
    }
}

// Retrieve lost items
$lost_sql = "SELECT * FROM lost_items";
$lost_result = $conn->query($lost_sql);

// Retrieve found items
$found_sql = "SELECT * FROM found_items";
$found_result = $conn->query($found_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lost and Found Items</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Lost Items</h2>
<table>
    <tr>
        <th>Item Name</th>
        <th>Description</th>
        <th>Location</th>
        <th>Date</th>
        <th>Contact Info</th>
    </tr>
    <?php if ($lost_result->num_rows > 0): ?>
        <?php while($row = $lost_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['contact_info']; ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No lost items found.</td></tr>
    <?php endif; ?>
</table>

<h2>Found Items</h2>
<table>
    <tr>
        <th>Item Name</th>
        <th>Description</th>
        <th>Location</th>
        <th>Date</th>
        <th>Contact Info</th>
    </tr>
    <?php if ($found_result->num_rows > 0): ?>
        <?php while($row = $found_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['contact_info']; ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No found items found.</td></tr>
    <?php endif; ?>
</table>

<?php $conn->close(); ?>
</body>
</html>
