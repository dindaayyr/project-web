<?php
$db = mysqli_connect('localhost', 'root', '', 'umrohqueens_db');
$res = mysqli_query($db, 'SELECT * FROM travel_agents');
while($row = mysqli_fetch_assoc($res)) {
    echo "Agent: " . $row['id'] . " - " . $row['name'] . "\n";
}
$res = mysqli_query($db, 'SELECT * FROM paket_umroh');
while($row = mysqli_fetch_assoc($res)) {
    echo "Package: " . $row['id_paket'] . " - " . $row['nama_paket'] . " (Agent: " . $row['travel_agent_id'] . ")\n";
}
?>
