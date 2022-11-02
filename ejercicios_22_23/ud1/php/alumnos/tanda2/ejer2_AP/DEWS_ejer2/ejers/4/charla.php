<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            border-collapse: collapse;
        }

        iframe {
            border: solid 1px black;
            resize: both;
            overflow: auto;
            margin: 0;
        }

        table {
            margin: 0;
            border: solid 1px black;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <?php
        session_start();
        if (isset($_POST['logout'])) {
            session_start();
            $_SESSION['loged']='';
            header("Location: login.php");
        }

        if (isset($_POST['enviar'])) {
            $fichero = fopen("charla.txt","a");
            $msg = $_POST['msg'];
            $msg = str_replace(">", "", $msg);
            $msg = str_replace("<", "", $msg);
            $msg = "<strong>" . $_SESSION['loged'] . "</strong>: " . $msg . "\n";
            fwrite($fichero, $msg);
            fclose($fichero);
        }
    ?> 
    <?php if ($_SESSION['loged']!=null) : ?>
        <td colspan="2"><iframe src="contenido_charla.php" frameborder="0"></iframe></td>
        <table>
            <tr>
                <td>Usuario:</td>
                <td><?php echo $_SESSION['loged']; session_abort();?></td>
            </tr>
            <tr>
                <form action="charla.php" method="post">
                    <td><input type="submit" name="enviar" value="ENVIAR"/></td>
                    <td><input id="text" type="text" name="msg" autofocus required/></td>
                </form>
            </tr>
            <tr>
                <form action="charla.php" method="post">
                    <td colspan="2"><input type="submit" name="logout" value="SALIR"></td>
                </form>
            </tr>
        </table>
    <?php else: ?>
        <?php header("Location: login.php"); ?>
    <?php endif; ?>
</body>
</html>