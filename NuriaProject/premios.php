<?php
session_start();

if (!isset($_SESSION['currentUser'])) {
    header('location:login.html');
    return;
}

$user = $_SESSION['currentUser']['user'];

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

try {
    $connection = new mysqli('localhost', 'DBUSER2020', 'DBPSWD2020');
    $connection->select_db('BD');

    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Premios</title>
        <meta name="author" content="Nuria">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery-3.4.0.min.js"></script>
        <script src="history.js"></script>
        <script src="rating.js"></script>
        <script src="notify.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <header>
            <h1>Todos los premios</h1>
            <nav>
                <a class="Página principal" href="restaurantes.php">Página Principal</a>
                <a class="Ayuda" href="Guias/guia_premios.html">Ayuda</a>
                <a class="Favoritos" href="favoritos.php">Favoritos</a>
                <a class="Mapa" href="mapa.html">Mapa</a>
            </nav>
        </header>
        <button id="inicio">Ir a inicio</button>
        <button id="atras">Ir a atras</button>
        <table class="premios">
            <thead>
                <tr>
                   <th>Restaurante</th>
                    <th>Premio</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $connection->prepare('SELECT restaurantes.nombre, premios.premio FROM premios, restaurantes WHERE premios.id_restaurante = restaurantes.id');
                $query->bind_result($restaurante, $premio);
                $query->execute();

                while ($query->fetch()) {
                    echo '<tr>';
                    echo '<td>';
                    echo $restaurante;
                    echo '</td>';
                    echo '<td>';
                    echo $premio;
                    echo '</td>';

                    echo '</tr>';
                
                ?>
                <?php        
                    }
                    $query->free_result();
                    $connection->close();
                } catch (mysqli_sql_exception  $e) {
                    header('location:error.php?mensaje=' . urlencode($e->getMessage()));
                }
                ?>
        </tbody>
    </table>

    <footer>
        <a href="https://validator.w3.org/check?uri=referer">
            <img src="https://www.w3.org/html/logo/badge/html5-badge-h-solo.png" alt=" HTML5 Válido!" height="64" width="63" /> </a>

        <a href=" https://jigsaw.w3.org/css-validator/check/referer ">
            <img src=" https://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" height="31" width="88" /></a>
    </footer>
</body>

</html>