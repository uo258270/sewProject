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

    $query = $connection->prepare('SELECT * FROM restaurantes');
    $query->bind_result($nombre, $ubicacion, $id);
    $query->execute();

    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Restaurantes</title>
        <meta name="author" content="Nuria">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="jquery-3.4.0.min.js"></script>
        
        <script src="rating.js"></script>
        <script src="notify.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <header>
            <h1>Todos los Restaurantes</h1>
            <nav>
                <a title="Página principal" accesskey="r" tabindex="1" href="restaurantes.php">Pagina Principal</a>
                <a title="Ayuda" accesskey="a" tabindex="2" href="Guias/guia_restaurantes.html">Ayuda</a>
                <a title="Favoritos" accesskey="f" tabindex="3" href="favoritos.php">Favoritos</a>
                <a title="Mapa" accesskey="c" tabindex="4" href="mapa.html">Mapa</a>
                <a title="Reseñas" accesskey="p" tabindex="5" href="premios.php">Premios</a>
            </nav>
        </header>
        <table class="restaurantes">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicacion</th>
                    <th>Puntuacion</th>
                    <th>Favorito</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query->store_result();
                $queryF = $connection->prepare('SELECT COUNT(*) FROM favourites WHERE restaurante_id=? AND user_id=?');
                while ($query->fetch()) {
                    $queryF->bind_param('ss', $id, $user);
                    $queryF->bind_result($numero);

                    $queryF->execute();
                    $favorito = false;
                    if ($queryF->fetch()) {
                        $favorito = $numero > 0;
                    }

                    ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $ubicacion; ?></td>
                        <td class="rating" data-places="<?php echo $id; ?>"></td>
                        <td>
                            <?php if ($favorito) { ?>
                                Favorito
                            <?php } else { ?>
                                <a onclick="nota.spawnNotification('Acabas de añadir el restaurante a favoritos')" href="add.php?id=<?php echo $id ?>">Marcar como favorito</a>
                            <?php } ?>
                        </td>
                    </tr>
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