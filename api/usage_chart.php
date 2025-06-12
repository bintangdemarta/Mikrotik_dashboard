<?php
$db = new mysqli('localhost', 'root', '', 'mikrotik_dashboard');
if ($db->connect_error) {
    die(json_encode(['error' => 'DB connection failed']));
}

$data = [];

for ($hour = 0; $hour < 24; $hour++) {
    $start = sprintf('%02d:00:00', $hour);
    $end = sprintf('%02d:59:59', $hour);

    $result = $db->query("
        SELECT SUM(rx + tx) as total
        FROM traffic_log
        WHERE DATE(created_at) = CURDATE()
        AND TIME(created_at) BETWEEN '$start' AND '$end'
    ");

    $row = $result->fetch_assoc();
    $total_bits = $row['total'] ?? 0;
    $total_mb = $total_bits / 8 / 1024 / 1024;
    $data[] = round($total_mb, 2);
}

echo json_encode($data);
