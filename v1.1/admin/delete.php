<?php
include '../auth.php';
include '../db.php';

$id = $_GET['id'];

$query = "DELETE FROM ums.users WHERE id = $1";
$result = pg_query_params($conn, $query, array($id));

header("Location: users.php");
?>