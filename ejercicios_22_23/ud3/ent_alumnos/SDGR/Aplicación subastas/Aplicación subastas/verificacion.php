<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion</title> 
</head>
<body>
    <?php include "config.php";
        if(isset($_GET["mail"]) && isset($_GET["cadenaVer"])){
            $mail = $_GET["mail"];
            $cadena = $_GET["cadenaVer"];
            $sql = "UPDATE usuarios SET activo = 1, falso = 0 WHERE $mail = email AND $cadena = cadenaverificacion";
            $conn->query($sql);  
            if($conn->errno)
                echo "<p>No se puede verificar dicha cuenta</p>";
            else
                echo "<p>Se ha verificado tu cuenta. Puedes entrar pinchando <a href='login.php'>log in</a></p>";
        }
    ?>
</body>
</html>