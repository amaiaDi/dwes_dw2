<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <style>
        .pf{
            background-color:gray;
            text-align:center;
        }
    </style>
<body>

<?php

if(isset($_POST["nombre"])){
    $_SESSION["userN"]=$_POST["nombre"];
    $_SESSION["userP"]=$_POST["contrasena"];
    header("location: validacion.php");
}
if(isset($_GET["error"])){
    print 'ERROR CONTRASEÑA INCORRECTA PARA: '.$_SESSION["userN"];
}

?>
<?php if(isset($_GET["ok"])!=1): ?>
    <form action='login.php' method='post'>
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input type='text' id='nombre' name='nombre'></td>
                <td colspan="2"><button type="submit" name="log" value="b" id="log">Añadir</button></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type='text' id='contrasena' name='contrasena'></td>
                
            </tr>
        </table>
    </form>
<?php else:?>
    <?php print $_SESSION["nombre"].": Has sido dado de alta"."</br>";
    
    print "<a href='charla.php?'>CHAT!!</a>";
    ?>
    
<?php endif;?>
</body>
</html>