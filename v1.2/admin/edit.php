<?php
include '../auth.php';
include '../db.php';

$id = $_GET['id'];

$query = "SELECT * FROM ums.users WHERE id = $1";
$result = pg_query_params($conn, $query, array($id));
$user = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | Admin Panel | User Manage</title>
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-96">

    <!-- Error Message -->
    <?php if (isset($_GET['error'])) { ?>
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php } ?>
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>

        <a href="../admin/users.php" 
        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            ← Back
        </a>
    </div>

    <form method="POST" action="update.php" class="space-y-4">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <input type="text" name="name" value="<?= $user['name'] ?>" 
            class="w-full border p-2 rounded" placeholder="Name">

        <input type="email" name="email" value="<?= $user['email'] ?>" 
            class="w-full border p-2 rounded" placeholder="Email">

        <select name="role" class="w-full border p-2 rounded">
            <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
            <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
        </select>

        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">
            Update
        </button>
    </form>

</div>

    <script>
    setTimeout(() => {
        const errorAlert = document.querySelector('.bg-red-100');
        if (errorAlert) errorAlert.style.display = 'none';
    }, 3000);
    </script>

</body>
</html>