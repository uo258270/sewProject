<?php
session_start();

if (!isset($_SESSION['currentUser'])) {
    header('location:login.html');
    return;
}

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

try {
    $connection = new mysqli('localhost', 'DBUSER2020', 'DBPSWD2020');
    $connection->select_db('BD');

    $user = $_SESSION['currentUser']['user'];

    $query = $connection->prepare('SELECT restaurantes.nombre, restaurantes.ubicacion, restaurantes.id FROM restaurantes JOIN favourites ON restaurantes.id = favourites.restaurante_id where favourites.user_id = ?');
    $query->bind_param('s', $user);
    $query->bind_result($nombre, $ubicacion, $id);
    $query->execute();

    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Restaurantes Favoritos</title>
        <meta name="author" content="Nuria">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery-3.4.0.min.js"></script>
        <script src="rating.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <header>
            <h1>Tus restaurantes favoritos</h1>

            <nav>
                <a class="Página principal" href="restaurantes.php">Página Principal</a>
                <a class="Ayuda" href="Guias/guia_favoritos.html">Ayuda</a>
                <a class="Favoritos" href="favoritos.php">Favoritos</a>
                <a class="Mapa" href="mapa.html">Mapa</a>
                <a class="Premios" href="premios.php">Premios</a>
            </nav>
        </header>
        <table class="restaurantes">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($query->fetch()) {
                    ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $ubicacion; ?></td>
                    </tr>
                <?php
            }
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

        <a href=" http://jigsaw.w3.org/css-validator/check/referer ">
            <img src=" http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" height="31" width="88" /></a>
    </footer>
</body>

</html>