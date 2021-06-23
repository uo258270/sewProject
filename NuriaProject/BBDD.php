<?php

$servername = "localhost";
$username = "DBUSER2020";
$password = "DBPSWD2020";
$database = "BD";
$usuarios = "user";
$restaurantes = "restaurantes";
$favoritos = "favourites";

try {
    $connection = new mysqli($servername, $username, $password);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $crearbase = "CREATE DATABASE IF NOT EXISTS " . $database . " COLLATE utf8_spanish_ci";
    $connection->query($crearbase);

    $connection->select_db($database);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LA TABLA USER // 

    $crearTabla = "CREATE TABLE IF NOT EXISTS " . $usuarios . " (
        name varchar(64) NOT NULL,
        email varchar(64) NOT NULL,
        password varchar(256) NOT NULL,
            PRIMARY KEY (email))";

    $connection->query($crearTabla);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LAS TABLA RESTAURANTES // 

    $crearTabla2 = "CREATE TABLE IF NOT EXISTS " . $restaurantes . " (
        nombre varchar(50) NOT NULL,
        ubicacion varchar(50) NOT NULL,
        id varchar(50) NOT NULL,
            PRIMARY KEY (id))";

    $connection->query($crearTabla2);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LOS RESTAURNTES // 

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Gloria Oviedo", "Oviedo", "ChIJv_x0pwKNNg0Rpu1Hcj2XTuk")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Sidrería El Gato Negro", "Oviedo", "ChIJ24wgHe-MNg0RWDddO1n0EdU")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Restaurante De Labra Oviedo", "Oviedo", "ChIJ__-TxIOMNg0RscAppeLHb84")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Casa Fermin", "Oviedo", "ChIJKYdwaeWMNg0RJNh1gf9OAy4")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Tierra Astur Gascona", "Oviedo", "ChIJs6gyJPCMNg0R4xx3L8WrCy0")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("La Corte de Pelayo", "Oviedo", "ChIJOQ0SGuWMNg0RSZ0UX3s5-LU")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("La Genuina de Cimadevilla", "Oviedo", "ChIJ3TzJDO-MNg0R6xBU-yeHm6U")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Mesón la Comtienda Oviedo", "Oviedo", "ChIJNQVkQfyMNg0Ro7yUfpcb8-8")';
    $connection->query($crearRestaurantes);

   

    

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LAS TABLA FAVOURITES // 

    $crearFavoritas = "CREATE TABLE IF NOT EXISTS " . $favoritos . " (
        user_id varchar(50) NOT NULL,
        restaurante_id varchar(50) NOT NULL,
        FOREIGN KEY (restaurante_id) REFERENCES restaurantes(Id),
        FOREIGN KEY (user_id) REFERENCES user(Email))";

    $connection->query($crearFavoritas);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $connection->close();
} catch (mysqli_sql_exception  $e) {
    header('location:error.php?mensaje=' . urlencode($e->getMessage()));
}
