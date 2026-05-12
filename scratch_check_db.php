<?php

require 'app/Config/Constants.php';
require 'system/bootstrap.php';

$db = \Config\Database::connect();
$query = $db->query("SHOW COLUMNS FROM bookings");
$results = $query->getResultArray();

foreach ($results as $row) {
    echo $row['Field'] . "\n";
}
