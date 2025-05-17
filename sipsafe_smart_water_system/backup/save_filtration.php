<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $water_type = $_POST['water_type'];
    $quality_metric = $_POST['quality_metric'];

    // Retrieve the user_id using the username
    $user_query = $conn->prepare("SELECT id FROM Users WHERE username = ?");
    $user_query->bind_param("s", $username);
    $user_query->execute();
    $user_result = $user_query->get_result();

    if ($user_result->num_rows === 1) {
        $user = $user_result->fetch_assoc();
        $user_id = $user['id'];

        // Insert the record into the database
        $query = $conn->prepare("INSERT INTO User_Filtration_Record (user_id, water_type, quality_metric) VALUES (?, ?, ?)");
        $query->bind_param("isd", $user_id, $water_type, $quality_metric);

        if ($query->execute()) {
            // Redirect to the dashboard with updated details
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: User not found.";
    }
}
?>
