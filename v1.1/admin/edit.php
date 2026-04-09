<?php
include '../auth.php';
include '../db.php';

$id = $_GET['id'];

$query = "SELECT * FROM ums.users WHERE id = $1";
$result = pg_query_params($conn, $query, array($id));
$user = pg_fetch_assoc($result);
// print_r($user);
?>

<h2>Edit User</h2>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    Name: <input type="text" name="name" value="<?= $user['name'] ?>"><br><br>
    Email: <input type="email" name="email" value="<?= $user['email'] ?>"><br><br>

    Role:
    <select name="role">
        <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>