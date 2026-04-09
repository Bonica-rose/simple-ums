<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | User Management</title>

    <!-- Favicon -->
    <link rel="icon" href="../favicon.ico">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-100 to-indigo-200 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">
            Login to Your Account
        </h2>

        <!-- Success Message -->
        <?php if (isset($_GET['success'])) { ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php } ?>

        <!-- Error Message -->
        <?php if (isset($_GET['error'])) { ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php } ?>

        <?php
            session_start();
            if (isset($_SESSION['errors'])) {
                echo '<div class="bg-red-100 text-red-700 p-3 rounded mb-4">';
                foreach ($_SESSION['errors'] as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
                unset($_SESSION['errors']);
            }
        ?>

        <!-- Form -->
        <form method="POST" action="./loginCheck.php" class="space-y-5">

            <!-- Email -->
            <div>
                <label class="block text-gray-600 mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-600 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your password">
            </div>

            <!-- Remember + Forgot -->
            <!-- <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2"> Remember me
                </label>
                <a href="#" class="text-blue-500 hover:underline">Forgot password?</a>
            </div> -->

            <!-- Button -->
            <button type="submit"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg font-semibold transition duration-200">
                Login
            </button>

        </form>

        <!-- Register Link -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Don't have an account?
            <a href="./register.php" class="text-blue-500 hover:underline">Sign Up</a>
        </p>

    </div>

    <script>
    setTimeout(() => {
        const errorAlert = document.querySelector('.bg-red-100');
        if (errorAlert) errorAlert.style.display = 'none';

        const successAlert = document.querySelector('.bg-green-100');
        if (successAlert) successAlert.style.display = 'none';
    }, 3000);
    </script>
</body>

</html>