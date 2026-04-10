<?php
session_start();
include '../db.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Get ID
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

// Prevent self delete
if ($id == $_SESSION['user_id']) {
    header("Location: users.php?error=" . urlencode("You cannot delete yourself"));
    exit();
}

// Soft delete (update status)
$query = "UPDATE ums.users SET status='inactive', actions='deleted' WHERE id=$1";
$result = pg_query_params($conn, $query, [$id]);

if ($result) {
    header("Location: users.php?success=" . urlencode("User deleted successfully"));
} else {
    header("Location: users.php?error=" . urlencode("Delete failed"));
}
exit();
?>