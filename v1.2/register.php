<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | User Management</title>

    <!-- Favicon -->
    <link rel="icon" href="../favicon.ico">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-100 to-indigo-200 min-h-screen flex items-center justify-center">

    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md my-5">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">
            Create an Account
        </h2>        

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
        <form method="POST" action="./registerUser.php" class="space-y-5">

            <!-- Name -->
            <div>
                <label class="block text-gray-600 mb-1">Name</label>
                <input type="text" name="name" 
                    
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your name">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-600 mb-1">Email</label>
                <input type="email" name="email" 
                    
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-600 mb-1">Password</label>
                <input type="password" name="password" 
                    
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your password">
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-gray-600 mb-1">Confirm Password</label>
                <input type="password" name="confirm-password" 
                    
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Confirm your password">
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg font-semibold transition duration-200">
                Sign Up
            </button>
        </form>

        <!-- Login Link -->
        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="./login.php" class="text-blue-500 hover:underline">Get Started</a>
        </p>
    </div>

    <script>
    setTimeout(() => {
        const alert = document.querySelector('.bg-red-100');
        if (alert) alert.style.display = 'none';
    }, 5000);
    </script>

</body>
</html>