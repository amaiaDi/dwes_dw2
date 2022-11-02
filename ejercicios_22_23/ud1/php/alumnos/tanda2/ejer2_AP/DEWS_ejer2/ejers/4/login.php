<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        a {
            font-size: 3em;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <?php error_reporting (E_ALL ^ E_NOTICE);
        if ($_GET['usuario']!=null) {
            echo "Contraseña erronea para " . $_GET['usuario'];
        }
        session_start();
    ?>
    <?php if ($_SESSION['loged']==null) : ?>
        <form action="validacion.php" method="post">
            <table>
                <tr>
                    <td>Nombre de Usuario:</td>
                    <td><input type="text" size="20" name="usuario" value="<?php echo $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';?>" required></td>
                    <td rowspan="2"><input type="submit" value="ENTRAR" name="login"></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" size="20" name="passw"></td>
                </tr>
            </table>
        </form>
    <?php else: ?>
        <p><strong><?php echo $_SESSION['loged']?></strong>: Has sido dado de alta<br></p>
        <a href='charla.php'>Entrar al chat</a>
    <?php endif; ?>
</body>
</html>