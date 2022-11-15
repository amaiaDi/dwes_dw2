<?php
    require("cabecera.php");
    if(isset($_GET['url']))
        $_SESSION['ultimaPagina'] = $_GET['url'];
    if(isset($_POST['botlogin'])){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM usuarios WHERE username = '".$usuario."'";
        $resultado = mysqli_query($con, $sql);
        if(!$resultado)
            echo mysqli_error($con);
        while($fila = mysqli_fetch_assoc($resultado)){
            if($fila['username'] == $usuario && $fila['password'] == $password){
                if($fila['activo'] == 1){
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['id'] = $fila['id'];
                    if(isset($_SESSION['ultimaPagina']))
                        header('Location: '.$_SESSION["ultimaPagina"]);
                    else{
                        $_SESSION['ultimaPagina'] = $_SERVER["REQUEST_URI"];    
                        header('Location: index.php');
                    }
                }
                else
                    echo "<p>Esta cuenta no esta verificada. Te hemos enviado un email para verificarte.</p>";
            }
            else
                echo "<p>Login incorrecto. Inténtelo de nuevo!</p>";
        }
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
    <h1>LOGIN</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
            <tr>
                <th>Usuario</th>
                <td><input type="text" name="usuario" required></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="botlogin" value="Login!"></td>
            </tr>
        </table>
    </form>
    <p>No tienes una cuenta? <a href="registro.php"><b>Registrate!</b></a></p>
    <?php  require("pie.php"); ?>
</body>
</html>