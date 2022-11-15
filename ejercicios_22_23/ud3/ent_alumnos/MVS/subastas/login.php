<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Subastas</title>
</head>
<body>
    <div id="header"><h1>SUBASTAS DEWS</h1></div>
    <div id="menu">
        <a href="index.php">Home</a>
        <a href="#">Login</a>
        <a href="#">Nuevo item</a>
    </div>
    <div id="container">
        <div id="bar">
            <?php
                include __DIR__ . '\barra.php';
            ?>
        </div>
        <div id="main">
            <?php
                if (isset($_POST['login']) && !empty($_POST['usu']) && !empty($_POST['pass'])) {
                    $usu=$_POST['usu'];
                    $pass=$_POST['pass'];
                    $mysqli = new mysqli("localhost", "marcos", "dw2", "subastas");
                    $sql="SELECT * FROM usuarios";
                    $resultado=$mysqli->query($sql);
                    $cont=0;
                    $esta=false;
                    $contra=false;
                    while($dato = $resultado->fetch_assoc())   {
                        if ($dato['username']==$usu) {
                            $esta=true;
                            $cont=$dato['activo'];
                            if ($dato['password']==$pass) {
                                $contra=true;
                            }
                        }
                    }
                    if ($esta==true) {
                        if ($cont==0) {
                            echo "<p>Esta cuenta no esta verificada. Te hemos enviado un email</p>";
                        }
                        else {
                            if ($contra==true) {
                                $_SESSION['user']=$usu;
                                $_SESSION['pass']=$pass;
                                header("Location: index.php");
                            }
                            else {
                                echo "<p>Login incorrecto. Intentalo de nuevo!</p>";
                            }
                        }
                        
                    }
                    else {
                        echo "<p>Login incorrecto. Intentalo de nuevo!</p>";
                    }
                    $mysqli->close();
                }
            ?>
            <table>
            <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <section><b>REGISTRO</b></section>
                <tr class="body">
                    <td>Usuario</td>
                    <td><input type="text" name="usu"></td>
                </tr>
                <tr class="body">
                    <td>Password</td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr class="body">
                    <td></td>
                    <td><input type="submit" value="Login!" name="login"></td>
                </tr>
            </form>
            </table>
            <p>No tienes una cuenta? <a href="registro.php">Registrate!</a></p>
        </div>
    </div>
</body>
</html>