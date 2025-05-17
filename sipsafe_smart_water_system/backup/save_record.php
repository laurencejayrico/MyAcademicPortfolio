<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $water_type = $_POST['water_type'];
    $ph = $_POST['ph'];
    $tds = $_POST['tds'];
    $turbidity = $_POST['turbidity'];

    $sql = "INSERT INTO User_Filtration_Record (user_id, water_type, ph, tds, turbidity)
            VALUES ('$user_id', '$water_type', '$ph', '$tds', '$turbidity')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
