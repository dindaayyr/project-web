<?php
$db = mysqli_connect('localhost', 'root', '', 'umrohqueens_db');
$hash = '$2y$10$iTr3Kvzwb/AbgrKJgD8hPOsbIw5NM/7edW3JaMufccyagPO8BpSGK';
mysqli_query($db, "UPDATE users SET password = '$hash' WHERE email = 'agent@annamiroh.com'");
echo mysqli_affected_rows($db) . " user updated.";
?>
