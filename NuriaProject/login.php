<?php
session_start();
include 'BBDD.php';

if (isset($_SESSION['currentUser'])) {
    header('location:restaurantes.php');
    return;
}

$user = $_POST['user'];
$password = $_POST['password'];

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

try {
    $connection = new mysqli('localhost', 'DBUSER2020', 'DBPSWD2020');
    $connection->select_db('BD');

    $query = $connection->prepare('SELECT email,name FROM USER WHERE email = ? AND password = SHA1(?)');
    $query->bind_param('ss', $user, $password);
    $query->bind_result($user, $name);
    $query->execute();
    if ($query->fetch()) {
        $_SESSION['currentUser'] = [
            'user' => $user,
            'name' => $name
        ];

        header('location:restaurantes.php');
    } else {
        header('location:login.html');
    }

    $connection->close();
} catch (mysqli_sql_exception  $e) {
    header('location:error.php?mensaje=' . urlencode($e->message));
}
