<?php
$db = mysqli_connect('localhost', 'root', '', 'umrohqueens_db');

// 1. Find An-Namiroh Agent ID
$res = mysqli_query($db, "SELECT id FROM travel_agents WHERE name LIKE '%An-Namiroh%' LIMIT 1");
$agent = mysqli_fetch_assoc($res);
$agentId = $agent['id'];

// 2. Find a package ID for this agent
$res = mysqli_query($db, "SELECT id_paket, harga_jual FROM paket_umroh WHERE travel_agent_id = $agentId LIMIT 1");
$package = mysqli_fetch_assoc($res);
$packageId = $package['id_paket'];
$price = $package['harga_jual'];

// 3. Find or Create a test jamaah user
$res = mysqli_query($db, "SELECT id FROM users WHERE email = 'jamaah_test@example.com' LIMIT 1");
if (mysqli_num_rows($res) > 0) {
    $user = mysqli_fetch_assoc($res);
    $userId = $user['id'];
} else {
    $pass = password_hash('password123', PASSWORD_DEFAULT);
    mysqli_query($db, "INSERT INTO users (name, email, password, role, phone) VALUES ('Jamaah Test', 'jamaah_test@example.com', '$pass', 'jamaah', '08123456789')");
    $userId = mysqli_insert_id($db);
}

// 4. Insert sample bookings
$code1 = 'BK-' . strtoupper(substr(md5(uniqid()), 0, 8));
mysqli_query($db, "INSERT INTO bookings (user_id, package_id, booking_code, total_price, status, created_at) VALUES ($userId, $packageId, '$code1', $price, 'lunas', NOW())");

$code2 = 'BK-' . strtoupper(substr(md5(uniqid()), 0, 8));
mysqli_query($db, "INSERT INTO bookings (user_id, package_id, booking_code, total_price, status, created_at) VALUES ($userId, $packageId, '$code2', $price, 'pending', NOW())");

echo "Sample bookings created for Agent ID $agentId and Package ID $packageId";
?>
