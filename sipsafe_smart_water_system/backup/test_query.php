<?php
include 'db_connect.php';

// Sample query to fetch all sensors
$sql = "SELECT * FROM Sensors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Location: " . $row["location"] . " - Parameter: " . $row["parameter"] . "<br>";
    }
} else {
    echo "No results found.";
}

$conn->close();
?>
