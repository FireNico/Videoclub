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
   
    if($_SESSION["rol"] == 2){
        //Parte del cliente
        
        echo "<h2>Listado de películas</h2>";
        echo "<a href='panelControl.php'>Volver al menú principal</a><br><br>";
        echo "<form action='listado.php' method='get'>
        <label for='estado'>Filtrar por estado</label>
        <select name='estado'>
        <option value=''>Todos</option>
        <option value='1'>Disponible</option>
        <option value='2'>Reservado</option>
        <option value='3'>Alquilado</option>
        <option value='4'>No Disponible</option>
        </select>
        <label for='nombre'>Buscar por nombre</label>
        <input type='text' name='nombre'>
        <input type='submit' value='Filtrar'><br><br>
        </form>
        ";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Título</th>";
        echo "<th>Género</th>";
        echo "<th>Año</th>";
        echo "<th>Estado</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
        if(isset($_GET["nombre"]) && $_GET["nombre"]!= ""){
            $consulta = "SELECT p.id as id, p.titulo, p.anio, g.nombre AS genero, e.id as id_estado, e.nombre as estado from peliculas p JOIN generos g ON g.id = p.genero_id JOIN estadospeliculas e ON e.id = p.estado_id WHERE p.titulo LIKE '%$_GET[nombre]%'";
        }else if(isset($_GET["estado"]) && $_GET["estado"]!= ""){
            $consulta = "SELECT p.id as id, p.titulo, p.anio, g.nombre AS genero, e.id as id_estado, e.nombre as estado from peliculas p JOIN generos g ON g.id = p.genero_id JOIN estadospeliculas e ON e.id = p.estado_id WHERE p.estado_id = '$_GET[estado]'";
        }else{
            $consulta = "SELECT p.id as id, p.titulo, p.anio, g.nombre AS genero, e.id as id_estado, e.nombre as estado from peliculas p JOIN generos g ON g.id = p.genero_id JOIN estadospeliculas e ON e.id = p.estado_id";
        }
        $resultado =  mysqli_query($base, $consulta);
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[titulo]</td>";
            echo "<td>$row[genero]</td>";
            echo "<td>$row[anio]</td>";
            switch($row["id_estado"]){

                case 1:
                    echo "<td style='color:green'>$row[estado]</td>";
                    break;
                case 2:
                    echo "<td style='color:yellow'>$row[estado]</td>";
                    break;
                case 3:
                    echo "<td style='color:red'>$row[estado]</td>";
                    break;
                case 4:
                    echo "<td style='color:red'>$row[estado]</td>";
                    break;

            }
            if($row["id_estado"] == 1){
            echo "<td><a href='gestionar.php?id=$row[id]'>Gestionar</a></td>";
            }else{
            echo "<td></td>";
            }
            echo "</tr>";
        }
        
        
    }elseif($_SESSION["rol"] == 1){

        echo "<h2>Listado de películas</h2>";
        echo "<a href='panelControl.php'>Volver al menú principal</a>";
        echo "<a href='nuevaPelicula.php'>Añadir película nueva</a><br><br>";
        echo "<form action='listado.php' method='get'>
        <label for='estado'>Filtrar por estado</label>
        <select name='estado'>
        <option value=''>Todos</option>
        <option value='1'>Disponible</option>
        <option value='2'>Reservado</option>
        <option value='3'>Alquilado</option>
        <option value='4'>No Disponible</option>
        </select>
        <label for='nombre'>Buscar por nombre</label>
        <input type='text' name='nombre'>
        <input type='submit' value='Filtrar'><br><br>
        </form>
        ";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Título</th>";
        echo "<th>Género</th>";
        echo "<th>Año</th>";
        echo "<th>Estado</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
        if(isset($_GET["nombre"]) && $_GET["nombre"]!= ""){
            $consulta = "SELECT p.id as id, p.titulo, p.anio, g.nombre AS genero, e.id as id_estado, e.nombre as estado from peliculas p JOIN generos g ON g.id = p.genero_id JOIN estadospeliculas e ON e.id = p.estado_id WHERE p.titulo LIKE '%$_GET[nombre]%'";
        }else if(isset($_GET["estado"]) && $_GET["estado"]!= ""){
            $consulta = "SELECT p.id as id, p.titulo, p.anio, g.nombre AS genero, e.id as id_estado, e.nombre as estado from peliculas p JOIN generos g ON g.id = p.genero_id JOIN estadospeliculas e ON e.id = p.estado_id WHERE p.estado_id = '$_GET[estado]'";
        }else{
            $consulta = "SELECT p.id as id, p.titulo, p.anio, g.nombre AS genero, e.id as id_estado, e.nombre as estado from peliculas p JOIN generos g ON g.id = p.genero_id JOIN estadospeliculas e ON e.id = p.estado_id";
        }
        $resultado =  mysqli_query($base, $consulta);
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>$row[titulo]</td>";
            echo "<td>$row[genero]</td>";
            echo "<td>$row[anio]</td>";
            switch($row["id_estado"]){

                case 1:
                    echo "<td style='color:green'>$row[estado]</td>";
                    break;
                case 2:
                    echo "<td style='color:yellow'>$row[estado]</td>";
                    break;
                case 3:
                    echo "<td style='color:red'>$row[estado]</td>";
                    break;                    
                case 4:
                    echo "<td style='color:red'>$row[estado]</td>";
                    break;                 

            }
            echo "<td><a href='gestionar.php?id=$row[id]'>Gestionar</a></td>";
            echo "</tr>";
        }

    
    }else{

        header("Location: login.php");

    }
    ?>        
    </main>
</body>
</html>
