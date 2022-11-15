<?php
    require("cabecera.php");
    if(isset($_SESSION['usuario']))
        $_SESSION['ultimaPagina'] = $_SERVER["REQUEST_URI"];
    if(isset($_POST['botregistrar'])){ 
        if(!existeUsuario($con,$_POST['usuario'])){
            $sql = "INSERT INTO usuarios (username,nombre,password,email,cadenaverificacion,activo,falso) VALUES ('".$_POST['usuario']."','".$_POST['nombre']."','".$_POST['password']."','".$_POST['email']."','".crearCadenaRandom()."', 0, 0)"; 
            $resultado = mysqli_query($con, $sql); 
            if(mysqli_errno($con)) die(mysqli_error($con));
        }
        else{
            echo "<script> alert('El usuario ".$_POST['usuario']." ya existe'); </script>";
        }
    }
    function crearCadenaRandom(){
        $randomstring="";
        for($i = 0; $i < 16; $i++) {
            $randomstring .= chr(mt_rand(32,126));
        }
        return $randomstring;
    }
    function existeUsuario($conn,$usuario){
        $sql = "SELECT count(*) FROM usuarios WHERE username='".$usuario."'";
        $resultado= mysqli_query($conn,$sql);
        if(mysqli_errno($conn)) die(mysqli_error($conn));
        $cant= mysqli_fetch_assoc($resultado);
        if($cant['count(*)'] == 1)
            return true;
        return false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo DB_TITULO." Registro"; ?></title>
</head>
<body>
    <h1>REGISTRO</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
            <tr>
                <th>Usuario</th>
                <td><input type="text" name="usuario" id="usuario" required></td>
            </tr>
            <tr>
                <th>Nombre completo</th>
                <td><input type="text" name="nombre" id="nombre" required></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="password" id="password" required></td>
            </tr>
            <tr>
                <th>Password (de nuevo)</th>
                <td><input type="password" name="password2" id="password2" required></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" name="email" id="email" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="botregistrar" value="Registrate"></td>
            </tr>
        </table>
    </form>
    <?php  require("pie.php"); ?>
<script src="./app.js"></script>
</body>
</html>