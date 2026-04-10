<?php
session_start();
include 'db.php';

// If DB failed -> redirect with error
if ($db_error) {
    header("Location: login.php?error=" . urlencode($db_error));
    exit();
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($_POST['email'])) {
        $errors[] = "Email is required";
    }

    if (empty($_POST['password'])) {
        $errors[] = "Password is required";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: login.php");
        exit();
    }    

    $query = "SELECT * FROM ums.users WHERE status = 'active' AND email = $1";
    $result = pg_query_params($conn, $query, array($email));

    if (!$result) {
        header("Location: login.php?error=" . urlencode("Something went wrong"));
        exit();
    }

    $user = pg_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard.php");
        exit();
    } else {
        // Send error message
        header("Location: login.php?error=" . urlencode("Invalid email or password or inactive user"));
        exit();
    }
}
?>