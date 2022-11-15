<?php
    require('header.php');
    echo "<h1>REGISTRO</h1>";

    if(isset($_GET['user']))
    {
        echo "<p style = 'color : red'>EL USUARIO '" . $_GET['user'] . "' YA EXISTE</p>";
    }
    else
    {
        echo "<p>Para registrarte en SUBASTAS SERGIO, rellena el siguiente formulario</p>";
    }
    if(isset($_POST['Registrarte']))
    {
        $usuario = $_POST['user'];
        $consultaUserSQL = "SELECT username FROM usuarios where username = '$usuario';";
        $resulUserSQL = mysqli_query($conn, $consultaUserSQL);
        $user = mysqli_fetch_assoc($resulUserSQL);
        if($user != null)
        {
            header("Location: registro.php?user=$usuario");
        }
        else
        {
            $consultaIdSQL = "SELECT max(id) FROM usuarios";
            $resulIdSQL = mysqli_query($conn, $consultaIdSQL);
            $maxId = mysqli_fetch_assoc($resulIdSQL);
            $id = $maxId['max(id)'] + 1;
            $insertarUser = "INSERT INTO usuarios VALUES('$id', '$usuario' , '" . $_POST['nombre'] . "', '" . $_POST['password'] . "', '" . $_POST['email'] . "', 'verific', 1, 0);";
            if(mysqli_query($conn, $insertarUser))
            {
                echo "<p style = 'font-size : 20px'>El usuario $usuario ha sido registrado correctamente!!!</p>";
                echo "<p style = 'font-size : 20px'>INICIA SESION DESDE AQUI! <a style = 'color : blue' href='login.php'>LOGIN</a></p>";
            }
        }
    }
?>
<form action="registro.php" method="post">
    <table>
        <tr>
            <td><label for="user">Usuario</label></td>
            <td><input type="text" name="user"></td>
        </tr>
        <tr>
            <td><label for="nombre">Nombre completo</label></td>
            <td><input type="text" name="nombre"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td><label for="password-repeat">Password (de nuevo)</label></td>
            <td><input type="password" name="password-repeat"></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="Registrarte" value="Registrarte"></td>
        </tr>
    </table>
</form>
<script src="assets/js/registro.js"></script>
<?php
    require('pie.php');
?>