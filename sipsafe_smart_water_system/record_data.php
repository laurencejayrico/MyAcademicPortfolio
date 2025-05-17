<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch filter types (e.g., Mineral, Alkaline, Tap) from the database
$filters_query = $conn->query("SELECT * FROM Filters");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $water_type = $_POST['water_type'];
    $ph_quality = $_POST['ph_quality'];
    $tds_quality = $_POST['tds_quality'];
    $turbidity_quality = $_POST['turbidity_quality'];

    // Insert the filtration record into the database
    $stmt = $conn->prepare("INSERT INTO User_Filtration_Record (user_id, water_type, ph_quality, tds_quality, turbidity_quality) VALUES (?, ?, ?, ?, ?)");
    
    // Bind parameters to the prepared statement
    // 'i' for integer (user_id), 's' for string (water_type), 'd' for double (quality metrics)
    $stmt->bind_param("issdd", $user_id, $water_type, $ph_quality, $tds_quality, $turbidity_quality);

    $stmt->execute();
    $stmt->close();

    // Redirect to the dashboard after submitting
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Water Filtration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .navbar {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar .brand {
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-right: auto;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            margin-right: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #007BFF;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="number"], select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="brand">SIPSAFE</div>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>

    <!-- Form to record water filtration -->
    <div class="container">
        <h1>Record Water Filtration</h1>
        <form action="record_data.php" method="POST">
            <!-- Water Type Dropdown -->
            <label for="water_type">Water Type:</label>
            <select name="water_type" required>
                <option value="Mineral">Mineral</option>
                <option value="Alkaline">Alkaline</option>
                <option value="Tap">Tap</option>
            </select>

            <!-- pH Quality Input -->
            <label for="ph_quality">pH Quality:</label>
            <input type="number" name="ph_quality" step="0.01" required>

            <!-- TDS Quality Input -->
            <label for="tds_quality">TDS (Total Dissolved Solids) Quality:</label>
            <input type="number" name="tds_quality" step="0.01" required>

            <!-- Turbidity Quality Input -->
            <label for="turbidity_quality">Turbidity Quality:</label>
            <input type="number" name="turbidity_quality" step="0.01" required>

            <!-- Submit Button -->
            <button type="submit">Submit Record</button>
        </form>
    </div>
</body>
</html>
