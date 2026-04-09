<?php
// include 'auth.php';
// echo "Welcome User ID: " . $_SESSION['user_id']."<br>";

// if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
//     echo '<a href="../v1.1/admin/users.php">Users</a> | ';
// }
?>
<!-- <a href="logout.php">Logout</a> -->

<?php
include 'auth.php';

echo "Welcome User ID: " . $_SESSION['user_id'];
?>

<br><br>

<?php if ($_SESSION['role'] === 'admin') { ?>
    <a href="../v1.1/admin/users.php">Manage Users</a>
<?php } ?>

<br><a href="./logout.php">Logout</a>