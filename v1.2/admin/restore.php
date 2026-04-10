<?php
session_start();
include '../db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: users.php?error=" . urlencode("Invalid user ID"));
    exit();
}

if (!is_numeric($id)) {
    header("Location: users.php?error=" . urlencode("Invalid request"));
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: users.php?error=" . urlencode("Access denied"));
    exit();
}

$query = "UPDATE ums.users SET status='active', actions='updated' WHERE id=$1";
$result = pg_query_params($conn, $query, [$id]);

if ($result) {
    header("Location: users.php?success=" . urlencode("User restored successfully"));
} else {
    header("Location: users.php?error=" . urlencode("Restoration failed"));
}
exit();
?>