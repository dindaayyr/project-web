<?php
$db = mysqli_connect('localhost', 'root', '', 'umrohqueens_db');
if (!$db) die("Connection failed: " . mysqli_connect_error());

$hash = '$2y$10$UKp7hCyldMepInOApsRbJOtKFCOi8dLR9z9UwMwLlTDJ2hi3uSTSm';
$sql = "UPDATE users SET password = '$hash' WHERE email IN ('agent@annamiroh.com', 'pending@amanah.com')";

if (mysqli_query($db, $sql)) {
    echo mysqli_affected_rows($db) . " rows updated successfully.";
} else {
    echo "Error updating record: " . mysqli_error($db);
}
mysqli_close($db);
?>
