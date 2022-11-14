<?php
    require('header.php');
    echo "<h1>REGISTRO</h1>";

    if(isset($_POST['usuario']))
    {
        $usu = $_POST['usuario'];
        $consultaUsuario = "SELECT username from usuarios where username = '$usu';";
        $resultadoUsuario = mysqli_query($conn, $consultaUsuario);
        $usuario = mysqli_fetch_assoc($resultadoUsuario);
        if($usuario != null)
        {
            echo "<p style='color: red'> El usuario ".$usuario['username']." ya existe</p>";
        }
        else
        {
            $consultaID = "SELECT MAX(id) FROM usuarios";
            $resultadoID = mysqli_query($conn, $consultaID);
            $idMax = mysqli_fetch_assoc($resultadoID);
            $nuevoId = $idMax['MAX(id)'] + 1;
            $insertUsuario = "INSERT INTO usuarios VALUES($nuevoId, '$usu', '".$_POST['nombreCom']."', '".$_POST['password']."', '".$_POST['email']."', 'verific', 1, 0);";
            mysqli_query($conn, $insertUsuario);
            
            echo "<p style='Font-size: 1.5em'>Se ha guardado tu cuenta. PUEDES ENTRAR PINCHANDO <a href='login.php'><strong>LOG IN</strong></a></p>";
        }
    }
    else
    {
        echo "<p>Para registrarte en SUBASTAS UNAI, rellena el siguiente formulario</p>";
    }
?>
<form action="registro.php" method="post">
    <table>
        <tr>
            <td><label for="usuario">Usuario:</label></td>
            <td><input type="text" name="usuario"></td>
        </tr>
        <tr>
            <td><label for="nombreCom">Nombre Completo:</label></td>
            <td><input type="text" name="nombreCom"></td>
        </tr>
        <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td><label for="password1">Password (de nuevo):</label></td>
            <td><input type="password" name="password1"></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="registrar">Registrate</button></td>
        </tr>
    </table>
</form>
<script src="js/registrar.js"></script>

<?php
    require('pie.php');
?>