<?php
$conn = pg_connect("host=localhost dbname=user_management user=postgres password=sunny");

// This immediately stops execution (bad UX )
// if (!$conn) {
//     die("Connection failed");
// }

$db_error = null;

if (!$conn) {
    $db_error = "Database connection failed. Please try again later.";
}
?>