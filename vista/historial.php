<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
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
        echo "<h2>Historial de alguileres</h2>";
        echo "<a href='panelControl.php'>Volver al menú principal</a><br><br>";
        $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
        $cliente = "SELECT * FROM usuarios WHERE  id = '$_SESSION[id]'";
        $usuario =  mysqli_query($base, $cliente);
        if($row = mysqli_fetch_assoc($usuario)){
            echo "<table border='1'>";
            $total = "SELECT COUNT(*) as total FROM operaciones WHERE usuario_id = '$row[id]'";
            $suma =  mysqli_query($base, $total);
            if($total = mysqli_fetch_assoc($suma)){
                $devuelta = "SELECT COUNT(*) as total FROM historial WHERE usuario_id = '$row[id]' AND tipo_accion_id = 5";
                $devol =  mysqli_query($base, $devuelta);
                if($resta = mysqli_fetch_assoc($devol)){
                    echo "<tr>";
                    echo "<th>Pendientes de Devolver</th>";
                    echo "<td>". $total["total"] - $resta["total"]."</td>";
                    echo "</tr>";
                    
                }
                echo "<tr>";
                echo "<th>Total Alquiladas</th>";
                echo "<td>$total[total]</td>";
                echo "</tr>";
                echo "</table>";
            }

        }

        echo "<h1>Películas Reservadas</h1>";
        $usuarios = "SELECT * FROM historial h JOIN peliculas p ON p.id = h.pelicula_id WHERE usuario_id = '$_SESSION[id]' AND p.estado_id = 2 AND h.tipo_accion_id = 2";
        $resultado =  mysqli_query($base, $usuarios);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Título</th>";
        echo "<th>Fecha de Reserva</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[titulo]</td>";
            echo "<td>".substr($row["fecha_accion"], 0, 10)."</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<h1>Películas Pendientes de Devolver</h1>";
        $usuarios = "SELECT * FROM historial h JOIN peliculas p ON p.id = h.pelicula_id WHERE usuario_id = '$_SESSION[id]' AND p.estado_id = 3 AND h.tipo_accion_id = 3";
        $resultado =  mysqli_query($base, $usuarios);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Título</th>";
        echo "<th>Fecha de Alquiler</th>";
        echo "<th>Fecha Prevista de Devolución</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[titulo]</td>";
            echo "<td>".substr($row["fecha_accion"], 0, 10)."</td>";
            echo "<td>".substr($row["fecha_prevista_devolucion"], 0, 10)."</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<h1>Películas Alquiladas y Devueltas</h1>";
        $usuarios = "SELECT * , e.nombre as devolucion FROM historial h JOIN peliculas p ON p.id = h.pelicula_id JOIN estadosdevolucion e ON p.estado_id  = e.id JOIN estadospeliculas ep ON h.tipo_accion_id = ep.id WHERE usuario_id = '$_SESSION[id]' AND h.tipo_accion_id = 5";
        $resultado =  mysqli_query($base, $usuarios);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Título</th>";
        echo "<th>Tipo de Acción</th>";
        echo "<th>Estado de Devolución</th>";
        echo "<th>Fecha Prevista de Devolución</th>";
        echo "<th>Fecha de Devolución</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[titulo]</td>";
            echo "<td>$row[nombre]</td>";
            echo "<td>$row[devolucion]</td>";
            echo "<td>".substr($row["fecha_prevista_devolucion"], 0, 10)."</td>";
            echo "<td>".substr($row["fecha_accion"], 0, 10)."</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </main>
</body>
</html>