<?php require 'cabecera.php'; ?>
<body>
    <?php 
        if (isset($_POST['registrarse'])) {
            if (isset($_POST['user'])) {
                $user = $_POST['user'];
                if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                    if (isset($_POST['passw'])) {
                        $passw = $_POST['passw'];
                        if (isset($_POST['email'])) {
                            $email = $_POST['email'];
                            if (!comprobarSiExisteUsuario($conn, $user)) {
                                insertarUsuario($conn, $user, $name, $passw, $email);
                            }
                        }
                    }
                }
            }
        }
    ?>
    <h2>Registro</h2>
    <p>Para registrarte en <?php echo NOMBRE_FORO ?>, rellena el siguiente formulario:</p>
    <form action="registro.php" method="post">
        <table>
            <tr>
                <td><label for="user">Usuario</label></td>
                <td><input type="text" name="user" id="user"></td>
            </tr>
            <tr>
                <td><label for="name">Nombre Completo</label></td>
                <td><input type="text" name="name" id="name"></td>
            </tr>
            <tr>
                <td><label for="passw">Contraseña</label></td>
                <td><input type="password" name="passw" id="passw"></td>
            </tr>
            <tr>
                <td><label for="passw2">Repetir Contraseña</label></td>
                <td><input type="password" name="passw2" id="passw2"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="text" name="email" id="email"></td>
            </tr>
            <tr>
                <td colspan="2" class="registro"><input type="submit" value="Registrate" id="registrarse" name="registrarse" disabled></td>
            </tr>
        </table>
    </form>
    <div id="passwNoValida"></div>
    <?php 
        // Cerrar Container y Main
            echo "</div>";
        echo "</div>";
    ?>
    <script src="../js/app.js"></script>
</body>
</html>