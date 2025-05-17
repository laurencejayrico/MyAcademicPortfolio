<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the record ID from the URL
if (isset($_GET['id'])) {
    $record_id = $_GET['id'];

    // Delete the record from the database
    $delete_query = $conn->prepare("DELETE FROM User_Filtration_Record WHERE id = ?");
    $delete_query->bind_param("i", $record_id);

    if ($delete_query->execute()) {
        // Successfully deleted, redirect back to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Failed to delete, show an error
        echo "Error deleting the record. Please try again.";
    }
} else {
    // Invalid access, redirect to dashboard
    header("Location: dashboard.php");
    exit();
}
?>
