<?php
$db = mysqli_connect('localhost', 'root', '', 'umrohqueens_db');

// 1. Fix package ownership
mysqli_query($db, "UPDATE paket_umroh SET travel_agent_id = 4 WHERE nama_paket LIKE '%AN NAMIROH%'");
echo "Packages reassigned. ";

// 2. Insert sample bookings for Agent 4
$res = mysqli_query($db, "SELECT id_paket, harga_jual FROM paket_umroh WHERE travel_agent_id = 4 LIMIT 1");
if ($package = mysqli_fetch_assoc($res)) {
    $packageId = $package['id_paket'];
    $price = $package['harga_jual'];
    
    // Find/Create user
    $resUser = mysqli_query($db, "SELECT id FROM users WHERE email = 'jamaah_test@example.com' LIMIT 1");
    if ($user = mysqli_fetch_assoc($resUser)) {
        $userId = $user['id'];
    } else {
        $pass = password_hash('password123', PASSWORD_DEFAULT);
        mysqli_query($db, "INSERT INTO users (name, email, password, role, phone) VALUES ('Jamaah Test', 'jamaah_test@example.com', '$pass', 'jamaah', '08123456789')");
        $userId = mysqli_insert_id($db);
    }
    
    // Insert bookings
    $code1 = 'BK-AN' . rand(100, 999);
    mysqli_query($db, "INSERT INTO bookings (user_id, package_id, booking_code, total_price, status, created_at) VALUES ($userId, $packageId, '$code1', $price, 'lunas', NOW())");
    
    $code2 = 'BK-AN' . rand(100, 999);
    mysqli_query($db, "INSERT INTO bookings (user_id, package_id, booking_code, total_price, status, created_at) VALUES ($userId, $packageId, '$code2', $price, 'pending', NOW())");
    
    echo "Sample bookings created for Agent 4.";
} else {
    echo "No package found for Agent 4.";
}
?>
