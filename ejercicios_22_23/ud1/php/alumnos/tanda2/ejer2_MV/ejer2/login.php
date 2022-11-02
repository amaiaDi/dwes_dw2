<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['user2'])) {
                $user2= $_SESSION['user2'];
                echo "<p>CONTRASEÑA ERRONEA PARA <b> $user2 </b> <br> Intentalo de nuevo</p>";
                unset($_SESSION['user']);
                unset($_SESSION['pass']);
            }           
        ?>
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <tr>
                    <td>Nombre de usuario:</td>
                    <?php
                        if(isset($_SESSION['user2'])) {
                            $user2= $_SESSION['user2'];
                            echo "<td><input type='text' name='user' value=$user2></td>";
                        }
                        else {
                            
                    ?>
                    <td><input type="text" name="user"></td>
                    <?php
                        }
                    ?>
                    <td rowspan="2"><input type="submit" name="entrar" value="ENTRAR"></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" name="pass"></td>
                </tr>
            </table>
            <?php
                if (isset($_POST['entrar']) && !empty($_POST['user']) && !empty($_POST['pass'])){
                    $user=$_REQUEST['user'];
                    $pass=$_REQUEST['pass'];
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    header("Location: validacion.php");
                }
                else {
                    unset($_SESSION['user']);
                    unset($_SESSION['pass']);
                }
            ?>
        </form>
    </body>
</html>