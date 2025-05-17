<?php
include 'db_connect.php';

// Fetch counts for each water type
$count_query = "SELECT water_type, COUNT(*) as count FROM User_Filtration_Record GROUP BY water_type";
$count_result = $conn->query($count_query);

// Fetch detailed records
$detail_query = "SELECT u.username, r.water_type, r.ph, r.tds, r.turbidity, r.recorded_at
                 FROM User_Filtration_Record r
                 JOIN Users u ON r.user_id = u.id
                 ORDER BY r.recorded_at DESC";
$detail_result = $conn->query($detail_query);

// Output the summary and details
?>

<h2>Filtration Summary</h2>
<table border="1">
    <tr>
        <th>Water Type</th>
        <th>Count</th>
    </tr>
    <?php while ($row = $count_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['water_type']; ?></td>
            <td><?= $row['count']; ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Detailed Records</h2>
<table border="1">
    <tr>
        <th>Username</th>
        <th>Water Type</th>
        <th>pH Level</th>
        <th>TDS (ppm)</th>
        <th>Turbidity (NTU)</th>
        <th>Recorded At</th>
    </tr>
    <?php while ($row = $detail_result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['username']; ?></td>
            <td><?= $row['water_type']; ?></td>
            <td><?= $row['ph']; ?></td>
            <td><?= $row['tds']; ?></td>
            <td><?= $row['turbidity']; ?></td>
            <td><?= $row['recorded_at']; ?></td>
        </tr>
    <?php } ?>
</table>
