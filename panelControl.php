<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
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
        if($_SESSION["rol"] == 1){
        //Parte del administrador

        echo "<h2>Panel de control: ".$_SESSION["cargo"]."</h2>";
        echo "<div id='opciones'><div class='opcion' id='rojo'><a href='listado.php'>Gestionar películas</div>";
        echo "<div class='opcion' id='naranja'><a href='clientes.php'>Visualizar clientes</div></div>";
        
        }elseif($_SESSION["rol"] == 2){
        //Parte del cliente

            echo "<h2>Panel de control: ".$_SESSION["cargo"]."</h2>";
            echo "<div id='opciones'><div class='opcion' id='verde'><a href='listado.php'>Listado de películas</div>";
            echo "<div class='opcion marron'><a href='historial.php'>Historial</div>";
            echo "<div class='opcion' id='naranja'><a href='perfil.php'>Actualizar Perfil</div></div>";

        }else{

            header("Location: login.php");

        }
    ?>
    </main>
</body>
</html>


