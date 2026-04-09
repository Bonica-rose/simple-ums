<?php
session_start();
include 'db.php';

// If DB failed -> redirect with error
if ($db_error) {
    header("Location: register.php?error=" . urlencode($db_error));
    exit();
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = $_POST['confirm-password'];

    //  Name validation
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters";
    }

    // Email validation
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Password validation
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    // Conform password validation
    if (!empty($password) && empty($confirmPassword)) {
        $errors[] = "Confirm password is required";
    } elseif (!empty($password) && $confirmPassword !== $password) {
        $errors[] = "Confirm password do not match with password.";
    }

    // If errors -> redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: register.php");
        exit();
    }

    // Continue if valid
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO ums.users (name, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($name, $email, $hashedPassword));

    if(!$result ){
        header("Location: register.php?error=" . urlencode("Registration failed"));
    }

    header("Location: login.php?success=" . urlencode("Registered successfully"));
}
?>