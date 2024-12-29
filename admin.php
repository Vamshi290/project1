User
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
    // Update checked value
    if (!empty($_POST['item_id']) && isset($_POST['checked'])) {
        $item_id = $_POST['item_id'];
        $checked = $_POST['checked'];

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("UPDATE lost_found_items SET checked = ? WHERE id = ?");
        $stmt->bind_param("ii", $checked, $item_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Checked value updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// SQL query to retrieve data from the table
$sql = "SELECT * FROM lost_found_items";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row with option field
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Item Name: " . $row["item_name"] . "<br>";
        echo "Description: " . $row["description"] . "<br>";
        echo "Status: " . $row["status"] . "<br>";
        echo "Photo: <img src='" . $row["photo"] . "' alt='Item Photo' width='200'><br>";
        echo "Checked: " . ($row["checked"] ? "True" : "False") . "<br>";

        // Display form to update checked value
        echo "<form method='post'>";
        echo "<input type='hidden' name='item_id' value='" . $row["id"] . "'>";
        echo "<select name='checked'>";
        echo "<option value='1'>True</option>";
        echo "<option value='0'>False</option>";
        echo "</select>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";

        echo "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>