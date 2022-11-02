<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
        .rojo{
            color:red;
        }
        a{
            font-size:1.5em;
        }
    </style>
    <body>
        
        <?php
            $esta=-1;
            if(isset($_SESSION['userA']) && isset($_SESSION['passA'])) {
                $userA= $_SESSION['userA'];
                $passA= $_SESSION['passA'];
                $fp = fopen("usuarios.txt", "r");
                $esta=0;
                while(!feof($fp)) {
                    $linea = fgets($fp);
                    $user2=strstr($linea,",",true);
                    if (($user2==$userA)) {
                        $esta=1;
                    }
                }
                fclose($fp);
                if ($esta==0) {
                    $fp = fopen("usuarios.txt", "a+");
                    $datos = $userA.",".$passA."\n";
                    fputs($fp, $datos);
                    fclose($fp);
                    echo "<p><b> $userA </b>: Has sido dado de alta</p><p><a href='charla.php'>ENTRAR AL CHAT</a></p>";
                    unset($_SESSION['userA']);
                    unset($_SESSION['passA']);
                }
            }
            if ($esta==1) {
                echo "<p class='rojo'>Lo sentimos, ya existe un usuario <b> $userA </b></p>";
            }
            if ($esta==-1 || $esta==1) {
            
        ?>
        <p>REGISTRATE</p>
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <tr>
                    <td>Login:</td>
                    <td><input type="text" name="user"></td>
                    <td rowspan="2"><img src="imagenes/login.png" alt="login" width="100" height="100"></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" name="pass"></td>
                </tr>
            </table>
            <input type="submit" name="registrar" value="REGISTRAR">
            <?php
                if (isset($_POST['registrar']) && !empty($_POST['user']) && !empty($_POST['pass'])){
                    $user=$_REQUEST['user'];
                    $_SESSION['userA'] = $user;
                    $pass=$_REQUEST['pass'];
                    $_SESSION['passA'] = $pass;
                    header("Location: alta.php");
                }
                else {
                    unset($_SESSION['userA']);
                    unset($_SESSION['passA']);
                }
            ?>
        </form>
        <?php
            }
        ?>
    </body>
</html>