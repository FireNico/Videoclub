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

                echo "<h1>Reservar Película</h1>";
                
                echo "<a href='gestionarEstado.php?id=$row[id]'><button>Reservar Película</button></a>";
            }else{

                if($row["estado_id"] == 2){
                    $reserva = "SELECT u.nombre as nombre, h.fecha_accion as fecha_accion FROM historial h JOIN usuarios u ON h.usuario_id = u.id WHERE h.pelicula_id = $_GET[id] ORDER BY h.fecha_accion DESC LIMIT 1";
                    $historial = mysqli_query($base, $reserva);
                    while($row = mysqli_fetch_assoc($historial)){
                        echo "La película está reservada por $row[nombre] desde $row[fecha_accion]<br>";
                        echo "<form action='../vista/gestionarEstado.php' method='get'>";
                        echo "<label for='alquiler'>Fecha de Alquiler:</label><br>";
                        echo "<input name='alquiler' type='date'><br><br>";
                        echo "<label for='devolucion'>Fecha de Devolución:</label><br>";
                        echo "<input name='devolucion' type='date'><br><br>";
                        echo "<input type='submit' value='Alquilar Pelicula'>";
                        echo "<input type='hidden' name='id' value='$_GET[id]'>";
                        echo "</form>";
                    }

                }
                if(@$row["estado_id"] == 3){

                    $reserva = "SELECT u.nombre as nombre, h.fecha_accion as fecha_accion, h.fecha_prevista_devolucion as fecha_devolucion, u.id as id FROM historial h JOIN usuarios u ON h.usuario_id = u.id WHERE h.pelicula_id = $_GET[id] ORDER BY h.fecha_accion DESC LIMIT 1";
                    $historial = mysqli_query($base, $reserva);
                    while($row = mysqli_fetch_assoc($historial)){
                        echo "La película está actualmente alquilada por <a id='nombre' href='cliente.php?id=$row[id]'>$row[nombre]</a> desde ". substr($row["fecha_accion"], 0, 10)." y está prevista su devolucion el ". substr($row["fecha_devolucion"], 0, 10)."<br>";

                    }

                }
                if(@$row["estado_id"] == 1){

                    echo "Aqui se puede añadir un alquile de forma manual";

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