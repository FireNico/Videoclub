<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <main>
    <?php 

        if(isset($_POST["nombre"])){

            $base = mysqli_connect("127.0.0.1", "root", "", "videoclub");
            $new_pass = password_hash($_POST["contra"], PASSWORD_DEFAULT);
            $insert= "INSERT INTO usuarios (nombre, email, contrasena, rol_id, usuario) VALUES ('$_POST[nombre]', '$_POST[email]', '$new_pass', 2, '$_POST[usuario]')";
            $actualizar =  mysqli_query($base, $insert);
            echo "Usuario registrado";
        }


    ?>
    <h2>Bienvenido al Videoclub</h2>
    <form action="registro.php" method="post">
        <fieldset>
        <h1>Regustro de Usuario</h1>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" required><br><br>
        <label for="usuario">Usuario: </label>
        <input type="text" name="usuario" required><br><br>
        <label for="contra">Contraseña: </label>
        <input type="password" name="contra" required><br><br>
        <label for="email">Email: </label>
        <input type="email" name="email" required><br><br>
        <input type="submit"><br><br>
        <a href="login.php">Volver</a>
    </form>
    </main>
</body>
</html>