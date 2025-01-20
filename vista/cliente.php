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
        echo "<h2>Listado de clientes</h2>";
        echo "<a href='panelControl.php'>Volver al menú principal</a>";
        echo "<a href='clientes.php'>Volver a la lista de clientes</a><br><br>";
        $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
        $cliente = "SELECT * FROM usuarios WHERE  id = '$_GET[id]'";
        $usuario =  mysqli_query($base, $cliente);
        if($row = mysqli_fetch_assoc($usuario)){
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Título</th>";
            echo "<td>$row[nombre]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Email</th>";
            echo "<td>$row[email]</td>";
            echo "</tr>";
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

        if(isset($_GET["devolv"])){

            $devolucion = "UPDATE peliculas SET estado_id = 1 WHERE id = $_GET[pelicula_id]";
            $update = mysqli_query($base, $devolucion);
            $codigo_operacion = "SELECT o.codigo_operacion, o.usuario_id, h.fecha_prevista_devolucion, h.fecha_accion, o.pelicula_id FROM operaciones o JOIN historial h  ON o.pelicula_id = h.pelicula_id WHERE o.pelicula_id = '$_GET[pelicula_id]' ORDER BY fecha_operacion DESC LIMIT 1";
            $buscar_codigo =  mysqli_query($base, $codigo_operacion);
            if($row = mysqli_fetch_assoc($buscar_codigo)){
                $devoluccion = 1;
                $fecha_devolucion =  $_GET["devolv"];
                $historial = "INSERT INTO historial(usuario_id, pelicula_id, tipo_accion_id, fecha_accion, fecha_prevista_devolucion, estado_devolucion_id, codigo_operacion) VALUES ('$row[usuario_id]', '$row[pelicula_id]', 5, '$fecha_devolucion' , '$row[fecha_prevista_devolucion]', '$devoluccion', '$row[codigo_operacion]')";
                $operacion = mysqli_query($base, $historial);
                echo "Película devuelta con éxito";
            }

        }

        echo "<h1>Películas Alquiladas y Devueltas</h1>";
        $usuarios = "SELECT * , e.nombre as devolucion FROM historial h JOIN peliculas p ON p.id = h.pelicula_id JOIN estadosdevolucion e ON p.estado_id  = e.id JOIN estadospeliculas ep ON h.tipo_accion_id = ep.id WHERE usuario_id = '$_GET[id]' AND h.tipo_accion_id = 5";
        $resultado =  mysqli_query($base, $usuarios);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Código Operación</th>";
        echo "<th>Título</th>";
        echo "<th>Tipo de Acción</th>";
        echo "<th>Estado de Devolución</th>";
        echo "<th>Fecha Prevista de Devolución</th>";
        echo "<th>Fecha de Devolución</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[codigo_operacion]</td>";
            echo "<td>$row[titulo]</td>";
            echo "<td>$row[nombre]</td>";
            echo "<td>$row[devolucion]</td>";
            echo "<td>".substr($row["fecha_prevista_devolucion"], 0, 10)."</td>";
            echo "<td>".substr($row["fecha_accion"], 0, 10)."</td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<h1>Películas Pendientes de Devolver</h1>";
        $usuarios = "SELECT * FROM historial h JOIN peliculas p ON p.id = h.pelicula_id JOIN estadospeliculas e ON p.estado_id  = e.id WHERE usuario_id = '$_GET[id]' AND p.estado_id = 3 AND h.tipo_accion_id = 3";
        $resultado =  mysqli_query($base, $usuarios);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Código Operación</th>";
        echo "<th>Título</th>";
        echo "<th>Tipo de Acción</th>";
        echo "<th>Estado de Devolución</th>";
        echo "<th>Fecha Prevista de Devolución</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[codigo_operacion]</td>";
            echo "<td>$row[titulo]</td>";
            echo "<td>$row[nombre]</td>";
            if($row["estado_devolucion_id"] == NULL){
                echo "<td>No devuelta</td>";
            };
            echo "<th>".substr($row["fecha_prevista_devolucion"], 0, 10)."</th>";
            echo "<td>
            <form action='cliente.php' method='get'>
            <label for='devolv'>Fecha de Devolución: </label>
            <input type='date' name='devolv'><br>
            <input type='submit' value='Confirmar Devolución'>;
            <input type='hidden' name='id' value='$_GET[id]'>
            <input type='hidden' name='pelicula_id' value='$row[pelicula_id];'>
            </form>
            </td>";
            echo "</tr>";
        }


        ?>
    </main>
</body>
</html>
