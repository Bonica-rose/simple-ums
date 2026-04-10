<?php
include 'db.php';

$name = 'xx';
$email = 'xx@gmail.com';
$password = 'xxx';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO ums.users (name, email, password) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, array($name, $email, $hashedPassword));

if(!$result ){
    echo "Registration failed! ".pg_last_error($conn);
}

echo "Registered successfully";


?>