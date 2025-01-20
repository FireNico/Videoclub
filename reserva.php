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
        <h3><?php echo "Bienvenido, ".$_SESSION["nombre"]." ";?> <a href="login.php"><img src="logout.png" alt="Cerrar sesión"></a></h3>
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