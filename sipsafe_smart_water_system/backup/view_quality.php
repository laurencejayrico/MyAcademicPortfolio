<?php
include 'db_connect.php';

// Fetch records
$sql = "SELECT u.username, f.type AS filter_type, r.quality_metric, r.recorded_at
        FROM User_Filtration_Record r
        JOIN Users u ON r.user_id = u.id
        JOIN Filters f ON r.filter_id = f.id
        ORDER BY r.recorded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Water Quality</title>
</head>
<body>
    <h2>Water Quality Records</h2>
    <table border="1">
        <tr>
            <th>User</th>
            <th>Filter Type</th>
            <th>Water Quality</th>
            <th>Recorded At</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['username']; ?></td>
                <td><?= $row['filter_type']; ?></td>
                <td><?= $row['quality_metric']; ?></td>
                <td><?= $row['recorded_at']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
