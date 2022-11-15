<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificasió</title>
</head>
<?php
    $cadenaVerificacion = $_GET['cadenaVerificacion'];
    $email = $_GET['email'];
    $sePudo = false;
    //Crear conexion BD
    include_once("config.php");
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

    //comprobar que la cadena y el email existan
        $sql = "SELECT cadenaverificacion,email
                from usuarios
                where cadenaverificacion = $cadenaVerificacion
                and email = '$email'";
        $result = mysqli_query($con, $sql);
        $fila = mysqli_fetch_assoc($result);
        if(sizeof($fila) > 0){
            $sePudo = true;
            $sql = "UPDATE usuarios 
                    SET activo = 1 
                    where email = '$email'";  
            $resultado = mysqli_query($con, $sql); 
        }

?>
<body>
    <?php 
        if($sePudo){
    ?>
    Se ha verificado tu cuenta, Puedes entrar pinchando
    <a href="login.php">log in</a>
    <?php 
        }else{
    ?>
    No se puede verificar dicha cuenta
    <?php 
        }
    ?>
</body>
</html>