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
            if(isset($_SESSION['user'])) {
                $user= $_SESSION['user'];
                if(isset($_SESSION['pass'])) {
                    $pass= $_SESSION['pass'];
                }
                $fp = fopen("usuarios.txt", "r");
                $esta=0;
                while(!feof($fp)) {
                    $linea = fgets($fp);
                    $user2=strstr($linea,",",true);
                    $pass2=strstr($linea,",");
                    $pass2=substr($pass2,1);
                    $pass2=trim($pass2);
                    if (($user2==$user)) {
                        if ($pass2==$pass) {
                            $esta=1;
                        }
                        else {
                            $esta=2;
                        }
                    }
                }
                fclose($fp);
                if ($esta==0) {
                    $_SESSION['user'] = $user;
                    header("Location: alta.php");
                }
                else {
                    if ($esta==1) {
                        $_SESSION['user'] = $user;
                        header("Location: charla.php");
                    }
                    else {
                        $_SESSION['user2'] = $user;
                        header("Location: login.php");
                    }
                }
            }
            else {
                unset($_SESSION['user']);
                unset($_SESSION['user2']);
            }
               
            
        ?>
    </body>
</html>