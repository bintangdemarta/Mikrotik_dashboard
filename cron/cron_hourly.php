<?php
require_once('../routeros_api.class.php');
$API = new RouterosAPI();
date_default_timezone_set('Asia/Jakarta');

if ($API->connect('10.10.10.1', 'Bintangdmrt', '1234')) {
    $data = $API->comm('/interface/monitor-traffic', [
        'interface' => 'ether1-ISP',
        'once' => ''
    ]);
    $API->disconnect();

    $rx = $data[0]['rx-bits-per-second'] ?? 0;
    $tx = $data[0]['tx-bits-per-second'] ?? 0;
    $hour = date('G');
    $date = date('Y-m-d');

    $db = new PDO("mysql:host=localhost;dbname=mikrotik_dashboard", "root", "");
    $stmt = $db->prepare("INSERT INTO traffic_hourly (hour, date, rx, tx) VALUES (?, ?, ?, ?)");
    $stmt->execute([$hour, $date, $rx, $tx]);
}
?>



