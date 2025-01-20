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
        echo "<a href='panelControl.php'>Volver al menú principal</a><br><br>";
        $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
        $usuarios = "SELECT * FROM usuarios WHERE rol_id = 2";
        $resultado =  mysqli_query($base, $usuarios);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Email</th>";
        echo "<th>Usuario</th>";
        echo "<th>Pendientes de Devolver</th>";
        echo "<th>Total Alquiladas</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[nombre]</td>";
            echo "<td>$row[email]</td>";
            echo "<td>$row[usuario]</td>";
            $total = "SELECT COUNT(*) as total FROM operaciones WHERE usuario_id = '$row[id]'";
            $suma =  mysqli_query($base, $total);
            if($total = mysqli_fetch_assoc($suma)){
                $devuelta = "SELECT COUNT(*) as total FROM historial WHERE usuario_id = '$row[id]' AND tipo_accion_id = 5";
                $devol =  mysqli_query($base, $devuelta);
                if($resta = mysqli_fetch_assoc($devol)){
                    echo "<td>". $total["total"] - $resta["total"]."</td>";
                }
                echo "<td>$total[total]</td>";
            }
            echo "<td><a href='cliente.php?id=$row[id]'>Ver Ficha</a></td>";
            echo "</tr>";
        }
        ?>
    </main>
</body>
</html>
