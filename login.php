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
    //Cuando accedes a la página de login cierra sesión
    session_start();
    @session_destroy(); ?>
    <h2>Bienvenido al Videoclub</h2>
    <form action="comprobarLogin.php" method="post">
            <fieldset>
            <legend>Login</legend>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" required><br><br>
            <label for="contra">Contraseña: </label>
            <input type="password" name="contra" required><br><br>
            <input type="submit">
            <p class="error"><?php echo isset($_GET["error"])?$_GET["error"]:"";?></p>
            <a href="registro.php">Registro nuevo usuario</a><br>
            <a href="recuperarContra.php">¿Olvidaste tu contraseña?</a>
            </fieldset>
        </form>
    </main>
</body>
</html>
