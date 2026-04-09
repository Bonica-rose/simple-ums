<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO ums.users (name, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($name, $email, $password));



    if ($result) {
        echo "Registered successfully";
        header("Location: login.html");
    } else {
        echo "Error ". pg_last_error($conn);
    }
}
?>