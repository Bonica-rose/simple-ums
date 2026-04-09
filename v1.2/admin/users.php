<?php
include '../auth.php';
include '../db.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$result = pg_query($conn, "SELECT * FROM ums.users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List | Admin Panel | User Manage</title>
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-xl p-6">

        <!-- Success Message -->
        <?php if (isset($_GET['success'])) { ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php } ?>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">User Management</h2>

            <a href="../dashboard.php" 
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                ← Back
            </a>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-800 text-white text-left">
                    <th class="p-3">ID</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = pg_fetch_assoc($result)) { ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?= $row['id'] ?></td>
                    <td class="p-3"><?= $row['name'] ?></td>
                    <td class="p-3"><?= $row['email'] ?></td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm 
                            <?= $row['role']=='admin' ? 'bg-green-200 text-green-800' : 'bg-blue-200 text-blue-800' ?>">
                            <?= $row['role'] ?>
                        </span>
                    </td>
                    <td class="p-3 space-x-2">
                        <a href="edit.php?id=<?= $row['id'] ?>" 
                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <a href="delete.php?id=<?= $row['id'] ?>" 
                        onclick="return confirm('Delete this user?')" 
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>

    <script>
    setTimeout(() => {
        const successAlert = document.querySelector('.bg-green-100');
        if (successAlert) successAlert.style.display = 'none';
    }, 3000);
    </script>

</body>
</html>