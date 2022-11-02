<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilos.css"></link>
    <title>Ejercicio 2 - Menu / Pedido - Sesiones</title>
</head>
<body>
    <?php
        // Incluimos los ficheros de funciones y constantes generales
        include_once("../constantes.php");
    ?>
    <?php
        //Se muestra error en caso de problemas de autenticacion
        $error="";
        if(isset($_GET['error']) && !empty($_GET['error'])){
            $error=constant($_GET['error']);
        }
    ?>
    <form action="autenticacion.php" method='post'>
        <table>
            <tr class="error">
                <td colspan="2">
                    <p><?php echo $error; ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p><?php echo SOCIO ?></p>
                </td>
            </tr>
            <tr>
                <td><?php echo USUARIO ?></td>
                <td> <input type="text" name="txtUsuario"></td>
            </tr>
            <tr>
                <td><?php echo PASSWORD ?></td>
                <td> <input type="password" name="txtPassword"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btnAccesoSocio" value="Acceso Socio"></input>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <hr size="2px" color="black" />
                <p><?php echo INVITADO ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="btnAccesoInvitado" value="Acceso Invitado"></input>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>