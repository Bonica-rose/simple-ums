<?php
session_start();

include 'auth.php';
include 'db.php';

// If DB failed -> redirect with error
if ($db_error) {
    header("Location: dashboard.php?error=" . urlencode($db_error));
    exit();
}

$totalUsers = pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM ums.users"), 0, 0);
$admins = pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM ums.users WHERE role='admin'"), 0, 0);
$normalUsers = pg_fetch_result(pg_query($conn, "SELECT COUNT(*) FROM ums.users WHERE role='user'"), 0, 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | User Management</title>

    <!-- Favicon -->
    <link rel="icon" href="../favicon.ico">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Sidebar -->
<div class="flex">

    <aside class="w-64 bg-gray-900 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>

        <nav class="space-y-4">
            <a href="#" class="block hover:bg-gray-700 p-2 rounded">Dashboard</a>

            <?php if ($_SESSION['role'] === 'admin') { ?>
                <a href="../v1.2/admin/users.php" class="block hover:bg-gray-700 p-2 rounded">
                    Manage Users
                </a>
            <?php } ?>

            <a href="./logout.php" 
                onclick="return confirm('Are you sure you want to logout?')"
                class="block hover:bg-red-600 p-2 rounded"
            >
                Logout
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">

        <!-- Top Bar -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Dashboard</h1>
            <div class="text-gray-600">
                Welcome, User ID: <?= $_SESSION['user_id'] ?>
            </div>
        </div>

        <!-- Error Message -->
        <?php if (isset($_GET['error'])) { ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php } ?>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Total Users</h3>
                <p class="text-2xl font-bold text-blue-500"><?= $totalUsers ?></p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Admins</h3>
                <p class="text-2xl font-bold text-green-500"><?= $admins ?></p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-gray-500">Normal Users</h3>
                <p class="text-2xl font-bold text-purple-500"><?= $normalUsers ?></p>
            </div>

        </div>

        <!-- Recent Section -->
        <div class="mt-8 bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>

            <div class="space-x-3">
                <?php if ($_SESSION['role'] === 'admin') { ?>
                <a href="../v1.2/admin/users.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    View Users
                </a>
                <?php } ?>

                <a href="./logout.php" 
                    onclick="return confirm('Are you sure you want to logout?')"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                >
                    Logout
                </a>
            </div>
        </div>

    </main>

</div>

<script>
setTimeout(() => {
    const errorAlert = document.querySelector('.bg-red-100');
    if (errorAlert) errorAlert.style.display = 'none';
}, 3000);
</script>

</body>
</html>