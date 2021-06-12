<?php

$servername = "localhost";
$username = "DBUSER2020";
$password = "DBPSWD2020";
$database = "BD";
$usuarios = "user";
$restaurantes = "restaurante";
$favoritos = "favourites";

try {
    $connection = new mysqli($servername, $username, $password);
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
        ubicacion varcahar(50) NOT NULL,
        id varchar(50) NOT NULL,
            PRIMARY KEY (id))";

    $connection->query($crearTabla2);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LOS RESTAURNTES // 

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Gloria Oviedo", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Sidrería El Gato Negro", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Restaurante De Labra Oviedo", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Casa Fermin", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Tierra Astur Gascona", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("La Corte de Pelayo", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("La Genuina de Cimadevilla", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

    $crearRestaurantes = 'INSERT INTO restaurantes (nombre, ubicacion, id) VALUES ("Mesón la Comtienda Oviedo", "Oviedo", "tt0120338")';
    $connection->query($crearRestaurantes);

   

    

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // CREO LAS TABLA FAVOURITES // 

    $crearFavoritas = "CREATE TABLE IF NOT EXISTS " . $favoritos . " (
        user_id varchar(50) NOT NULL,
        restaurante_id varchar(50) NOT NULL,
        FOREIGN KEY (restaurante_id) REFERENCES restaurante(Id),
        FOREIGN KEY (user_id) REFERENCES user(Email))";

    $connection->query($crearFavoritas);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $connection->close();
} catch (mysqli_sql_exception  $e) {
    header(' location: error . php ? mensaje =' . urlencode($e->message));
}
