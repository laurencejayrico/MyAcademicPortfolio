<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$user_query = $conn->query("SELECT username FROM Users WHERE id = $user_id");
$user = $user_query->fetch_assoc();
$username = $user['username'];

// Fetch water filtration records and statistics for the user
$filtration_query = $conn->query("
    SELECT 
        id, water_type, ph_quality, tds_quality, turbidity_quality, recorded_at
    FROM User_Filtration_Record
    WHERE user_id = $user_id
    ORDER BY recorded_at DESC
");

$filtration_records = [];
while ($row = $filtration_query->fetch_assoc()) {
    $filtration_records[] = $row;
}

// Fetch water filtration statistics
$stats_query = $conn->query("
    SELECT 
        water_type,
        COUNT(*) as count,
        AVG(ph_quality) as avg_ph,
        AVG(tds_quality) as avg_tds,
        AVG(turbidity_quality) as avg_turbidity
    FROM User_Filtration_Record
    WHERE user_id = $user_id
    GROUP BY water_type
");

$statistics = [];
while ($row = $stats_query->fetch_assoc()) {
    $statistics[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPSAFE Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        .navbar { background-color: #007BFF; color: white; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: white; text-decoration: none; margin-left: 15px; margin-right: 15px; }
        .navbar a:hover { text-decoration: underline; }
        .container { max-width: 900px; margin: 40px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); }
        h1 { color: #007BFF; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        button { padding: 10px 20px; background-color: #ff0000; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #cc0000; }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">SIPSAFE</div>
        <a href="record_data.php">Record Water Filtration</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($username); ?>!</h1>
        <p>This is your personalized dashboard for the SIPSAFE Smart Water System.</p>

        <h2>Water Filtration Statistics</h2>
        <table>
            <thead>
                <tr>
                    <th>Water Type</th>
                    <th>Times Chosen</th>
                    <th>Average pH</th>
                    <th>Average TDS</th>
                    <th>Average Turbidity</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($statistics) > 0): ?>
                    <?php foreach ($statistics as $stat): ?>
                        <tr>
                            <td><?= htmlspecialchars($stat['water_type']); ?></td>
                            <td><?= htmlspecialchars($stat['count']); ?></td>
                            <td><?= number_format($stat['avg_ph'], 2); ?></td>
                            <td><?= number_format($stat['avg_tds'], 2); ?></td>
                            <td><?= number_format($stat['avg_turbidity'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No data available yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Your Recorded Filtration Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Water Type</th>
                    <th>pH Quality</th>
                    <th>TDS Quality</th>
                    <th>Turbidity Quality</th>
                    <th>Recorded At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($filtration_records) > 0): ?>
                    <?php foreach ($filtration_records as $record): ?>
                        <tr>
                            <td><?= htmlspecialchars($record['water_type']); ?></td>
                            <td><?= number_format($record['ph_quality'], 2); ?></td>
                            <td><?= number_format($record['tds_quality'], 2); ?></td>
                            <td><?= number_format($record['turbidity_quality'], 2); ?></td>
                            <td><?= htmlspecialchars($record['recorded_at']); ?></td>
                            <td>
                                <a href="delete_record.php?id=<?= $record['id']; ?>"><button>Delete</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No filtration data recorded yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
