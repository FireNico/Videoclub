<?php

$connect = mysqli_connect("127.0.0.1", "root", "", "videoclub");

if($connect){

    $contrasenya = $_POST["contra"];
    $usuario = $_POST["usuario"];
    $consulta = "SELECT u.rol_id, u.contrasena, u.nombre AS nombre, r.nombre AS rol from usuarios u JOIN roles r  ON u.rol_id = r.id WHERE usuario = '$usuario'";
    $resultado =  mysqli_query($connect, $consulta);

    if ($row = mysqli_fetch_assoc($resultado)){
            
        $hashed_password_db = $row["contrasena"];

        if (password_verify($contrasenya, $hashed_password_db)){
            
            session_start();
            $_SESSION["usuario"] = $usuario;
            $_SESSION["rol"] = $row["rol_id"];
            $_SESSION["nombre"] = $row["nombre"];
            $_SESSION["cargo"] = $row["rol"];
            header("Location: panelControl.php");

       
        }else{

            header("Location: login.php?error=Contraseña incorrecta");
        
        }
    }else{
        
        header("Location: login.php?error=Usuario no econtrado"); 

    }


}
