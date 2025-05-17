<!-- record_filtration.php -->
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Assume the user ID is stored in the session
    $water_type = $_POST['water_type'];
    $quality_metric = $_POST['quality_metric'];

    // Insert the record into the database
    include 'db_connect.php';
    $query = "INSERT INTO User_Filtration_Record (user_id, water_type, quality_metric) 
              VALUES ('$user_id', '$water_type', '$quality_metric')";
    $conn->query($query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Filtration - SIPSAFE</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Record Water Filtration</h1>
    </header>

    <main>
        <form action="record_filtration.php" method="POST">
            <label for="water_type">Select Water Type:</label>
            <select name="water_type" required>
                <option value="Mineral">Mineral</option>
                <option value="Alkaline">Alkaline</option>
                <option value="Tap">Tap</option>
            </select><br><br>

            <label for="quality_metric">Water Quality (e.g., pH, TDS, Turbidity):</label>
            <input type="number" step="0.01" name="quality_metric" required><br><br>

            <button type="submit">Record Filtration</button>
        </form>
    </main>
</body>
</html>
