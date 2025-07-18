<?php
$db = new PDO("mysql:host=localhost;dbname=mikrotik_dashboard", "root", "");
$date = date('Y-m-d');
$sql = "SELECT hour, SUM(rx) as total_rx, SUM(tx) as total_tx 
        FROM traffic_hourly WHERE date = ? GROUP BY hour ORDER BY hour";
$stmt = $db->prepare($sql);
$stmt->execute([$date]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>