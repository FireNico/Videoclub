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

        echo "<h2>Editar Perfil</h2>";
        echo "<a href='panelControl.php'>Volver al menú principal</a><br><br>";

        $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");

        if(isset($_POST["actual"])){

            
            $cliente = "SELECT * FROM usuarios WHERE  id = '$_SESSION[id]'";
            $usuario =  mysqli_query($base, $cliente);
            if($row = mysqli_fetch_assoc($usuario)){

                $hashed_password_db = $row["contrasena"];
                $contrasenya = $_POST["actual"];

                if(password_verify($contrasenya, $hashed_password_db)){

                    if($_POST["nueva1"] == $_POST["nueva2"]){

                        $new_pass = password_hash($_POST["nueva1"], PASSWORD_DEFAULT);
                        $update= "UPDATE usuarios SET contrasena = '$new_pass' WHERE id = $row[id]";
                        $actualizar =  mysqli_query($base, $update);
                        echo "Contraseña actualizada";
                    }

                }

            }

        }

        $cliente = "SELECT * FROM usuarios WHERE id = '$_SESSION[id]'";
        $usuario =  mysqli_query($base, $cliente);
        if($row = mysqli_fetch_assoc($usuario)){
        echo "<form action='perfil.php' method='post'>
        <table border='1'>
        <tr>
        <th>Nombre</th>
        <td>$_SESSION[nombre]</td>
        </tr>
        <tr>
        <th>Email</th>
        <td><input type='text' name='correo' value='$row[email]' required></td>
        </tr>
        <tr>
        <th>Contraseña Actual</th>
        <td><input type='password' name='actual' required></td>
        </tr>
        <tr>
        <th>Nueva Contraseña</th>
        <td><input type='password' name='nueva1' required></td>
        </tr>
        <tr>
        <th>Confirmar Nueva Contraseña</th>
        <td><input type='password' name='nueva2' required></td>
        </tr>
        </table>
        <br>
        <input type='submit' value='Actualizar Perfil'><br><br>
        </form>
        ";

        }
        
    ?>
    </main>
</body>
</html>
