<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
       
        $nomUsu = "";
        $contr = "";
        

    ?>
    <body>   
            <form action="validacion.php"  method="post">
                        <?php 
                            if(isset($_GET['mensajeError'])){
                                echo $_GET['mensajeError'];
                                echo "<br>";
                            }
                        ?>
                        Nombre de usuario:
                        <input type="text" name="nombreUsuario" value="<?php echo $nomUsu; ?>" /><br>
                        Constraseña:
                        <input type="password" name="contraseña" value="<?php echo $contr; ?>" /><br>
                        <input type="submit" value="Entrar" name="botonLogin"/>
            </form>
    </body>
</html>