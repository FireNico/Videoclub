<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Página</title>
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

        if(isset($_GET["titulo"])){

            $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
            $insert = "INSERT INTO peliculas (titulo, genero_id, anio, estado_id) VALUES ('$_GET[titulo]', '$_GET[genero]', '$_GET[anio]', '$_GET[estado]')";
            $operacion = mysqli_query($base, $insert);
            echo "Película añadida con éxito";

        }


        echo "<h2>Insertar nueva película</h2>";
        echo "<a href='panelControl.php'>Volver al menú principal</a>";
        echo "<a href='listado.php'>Volver a la lista de películas</a><br><br>";
        echo "<form action='nuevaPelicula.php' method='get'>
        <label for='titulo'>Título</label><br>
        <input type='text' name='titulo' required><br><br>
        <label for='genero'>Género</label><br>
        <select name='genero'>
        <option value='1'>Acción</option>
        <option value='2'>Comedia</option>
        <option value='3'>Drama</option>
        <option value='4'>Ciencia ficción</option>
        <option value='5'>Horror</option>
        </select><br><br>
        <label for='anio'>Año</label><br>
        <input type='text' name='anio' required><br><br>
        <label for='estado'>Estado</label><br>
        <select name='estado'>
        <option value='1'>Disponible</option>
        <option value='2'>Reservado</option>
        <option value='3'>Alquilado</option>
        <option value='4'>No Disponible</option>
        </select><br><br>
        <input type='submit' value='Añadir Película'><br><br>
        </form>
        ";
        
    ?>
    </main>
</body>
</html>
