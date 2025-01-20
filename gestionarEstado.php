<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <?php session_start(); ?>
</head>
<body>
    <header>
        <h3>Sistema de gestión de Videoclub</h3>
        <h3><?php echo "Bienvenido, ".$_SESSION["nombre"]." ";?> <a href="login.php"><img src="logout.png" alt="Cerrar sesión" title="Cerrar sesión"></a></h3>
    </header>
    <main>
        <?php
        $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
        $consulta = "SELECT * FROM peliculas WHERE id = '$_GET[id]'";
        $resultado =  mysqli_query($base, $consulta);
        if($row = mysqli_fetch_assoc($resultado)){

            echo "<h2>Gestionar Película: $row[titulo] (id:$row[id])</h2>";
            if($_SESSION["rol"] == 2){

                $reserva = "UPDATE peliculas SET estado_id = 2 WHERE id = $row[id]";
                $update = mysqli_query($base, $reserva);
                echo "Película reservada y registrada en el historial con éxito";
                $insert = "INSERT INTO operaciones (usuario_id, pelicula_id, fecha_operacion) VALUES ('$_SESSION[rol]', '$row[id]', NOW())";
                $operacion = mysqli_query($base, $insert);
                $codigo_operacion = "SELECT LAST_INSERT_ID() AS codigo_operacion FROM operaciones";
                $buscar_codigo =  mysqli_query($base, $codigo_operacion);
                if($row = mysqli_fetch_assoc($buscar_codigo)){
                    $historial = "INSERT INTO historial(usuario_id, pelicula_id, tipo_accion_id, fecha_accion, codigo_operacion) VALUES ('$_SESSION[rol]', '$_GET[id]', 1,  NOW(), '$row[codigo_operacion]')";
                    $operacion = mysqli_query($base, $historial);
                }
            }else{

                if($row["estado_id"] == 2 || $row["estado_id"] == 3){

                    if($row["estado_id"] == 2){

                        $alquiler = "UPDATE peliculas SET estado_id = 3 WHERE id = $row[id]";
                        $update = mysqli_query($base, $alquiler);
                        $codigo_operacion = "SELECT codigo_operacion, usuario_id FROM operaciones WHERE pelicula_id = $_GET[id] ORDER BY fecha_operacion DESC LIMIT 1";
                        $buscar_codigo =  mysqli_query($base, $codigo_operacion);
                        if($row = mysqli_fetch_assoc($buscar_codigo)){
                            $historial = "INSERT INTO historial(usuario_id, pelicula_id, tipo_accion_id, fecha_accion, fecha_prevista_devolucion, codigo_operacion) VALUES ('$row[usuario_id]', '$_GET[id]', 1,  '$_GET[alquiler]', '$_GET[devolucion]', '$row[codigo_operacion]')";
                            $operacion = mysqli_query($base, $historial);
                }
                    }

                    $reserva = "SELECT u.nombre as nombre, h.fecha_accion as fecha_accion, h.fecha_prevista_devolucion as fecha_devolucion FROM historial h JOIN usuarios u ON h.usuario_id = u.id WHERE h.pelicula_id = $_GET[id] ORDER BY h.fecha_accion DESC LIMIT 1";
                    $historial = mysqli_query($base, $reserva);
                    while($row = mysqli_fetch_assoc($historial)){
                        echo "La película está actualmente reservada por $row[nombre] desde ". substr($row["fecha_accion"], 0, 10)." y está prevista su devolucion el ". substr($row["fecha_devolucion"], 0, 10)."<br>";

                    }

                }
            }
        }
        ?>
    </main>
    <footer>
        <a href="panelControl.php">Volver al menú principal</a>
        <a href="listado.php">Volver al listado de películas</a>
    </footer>
</body>
</html>