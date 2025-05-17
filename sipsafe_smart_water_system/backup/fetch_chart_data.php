<?php
include 'db_connect.php';

$query = "SELECT water_type, COUNT(*) as count, AVG(ph) as avg_ph, AVG(tds) as avg_tds, AVG(turbidity) as avg_turbidity
          FROM User_Filtration_Record GROUP BY water_type";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>
