<?php
session_start();

if (!isset($_SESSION['currentUser'])) {
    header('location:login.html');
    return;
}

$restaurante = $_GET['id'];
$user = $_SESSION['currentUser']['user'];

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

try {

    $connection = new mysqli('localhost', 'DBUSER2020', 'DBPSWD2020');
    $connection->select_db('BD');

    $query = $connection->prepare('INSERT INTO FAVOURITES VALUES (?, ?)');
    $query->bind_param('ss', $user, $restaurante);
    $query->execute();

    header('location:favoritos.php');

    $connection->close();
} catch (mysqli_sql_exception  $e) {
    header('location:error.php?mensaje=' . urlencode($e->getMessage()));
}