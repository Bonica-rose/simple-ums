<?php
include '../auth.php';
include '../db.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$result = pg_query($conn, "SELECT * FROM ums.users ORDER BY id DESC");
// pg_num_rows($result)
// while ($row = pg_fetch_assoc($result)) {
//     echo $row['name'] . " - " . $row['email'] . "<br>";
// }
?>

<h2>Users List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Actions</th>
</tr>

<?php while ($row = pg_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['role'] ?></td>
    <td>
        <a href="./edit.php?id=<?= $row['id'] ?>">Edit</a> 
        <?php if($row['id'] !== $_SESSION['user_id']) { ?>
        | <a href="./delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
        <?php } ?>
    </td>
</tr>
<?php } ?>
</table>

<br>
<a href="../dashboard.php">Back</a>