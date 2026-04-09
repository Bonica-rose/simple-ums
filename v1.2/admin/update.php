<?php
include '../auth.php';
include '../db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

$query = "UPDATE ums.users SET name=$1, email=$2, role=$3 WHERE id=$4";
$result = pg_query_params($conn, $query, array($name, $email, $role, $id));

if ($result) {
    header("Location: users.php?success=".urlencode("Updated successfully"));
} else {
    header("Location: edit.php?error=" . urlencode("Update failed"));
}
?>