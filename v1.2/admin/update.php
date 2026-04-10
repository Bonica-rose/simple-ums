<?php
include '../auth.php';
include '../db.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $status = isset($_POST['status']) ? $_POST['status'] : null;

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

    // If errors -> redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: edit.php?id=".$id);
        exit();
    }

    if ($status !== null) {
        // Update with status
        $query = "UPDATE ums.users SET name=$1, email=$2, status=$3 WHERE id=$4";
        $params = [$name, $email, $status, $id];
    } else {
        // Update without status
        $query = "UPDATE ums.users SET name=$1, email=$2 WHERE id=$3";
        $params = [$name, $email, $id];
    }

    $result = pg_query_params($conn, $query, $params);

    if ($result) {
        header("Location: users.php?success=".urlencode("Updated successfully"));
    } else {
        header("Location: edit.php?error=" . urlencode("Update failed"));
    }
}
?>