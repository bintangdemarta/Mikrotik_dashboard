<?php
require('../routeros_api.class.php');

$db = new mysqli('localhost', 'root', '', 'mikrotik_dashboard');
if ($db->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$API = new RouterosAPI();

if ($API->connect('10.10.10.1', 'Bintangdmrt', '1234')) {
    $data = $API->comm('/interface/monitor-traffic', [
        'interface' => 'ether1-ISP',
        'once' => ''
    ]);

    $rx = $data[0]['rx-bits-per-second'] ?? 0;
    $tx = $data[0]['tx-bits-per-second'] ?? 0;

    $stmt = $db->prepare("INSERT INTO traffic_log (rx, tx) VALUES (?, ?)");
    $stmt->bind_param("ii", $rx, $tx);
    $stmt->execute();

    $result = $db->query("
        SELECT SUM(rx + tx) as total_bits
        FROM traffic_log
        WHERE DATE(created_at) = CURDATE()
    ");
    $row = $result->fetch_assoc();
    $total_bits = $row['total_bits'] ?? 0;

    function format_speed($bps) {
        if ($bps >= 1048576) {
            return round($bps / 1048576, 2) . ' Mbps';
        } else {
            return round($bps / 1024, 2) . ' Kbps';
        }
    }

    function format_usage($bits) {
        $mb = $bits / 8 / 1024 / 1024;
        if ($mb >= 1024) {
            return round($mb / 1024, 2) . ' GB';
        } else {
            return round($mb, 2) . ' MB';
        }
    }

    $API->disconnect();

    echo json_encode([
        'rx' => format_speed($rx),
        'tx' => format_speed($tx),
        'total_usage' => format_usage($total_bits)
    ]);
} else {
    echo json_encode(['error' => 'Could not connect to Mikrotik']);
}
