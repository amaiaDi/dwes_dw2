<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function login() {
            $fichero = fopen("usuarios.txt", "r");
            $usuario = $_POST['usuario'];
            $password = $_POST['passw'];
            while (!feof($fichero)) {
                $linea = fgets($fichero);
                $linea = trim($linea);
                echo $linea . "<br>";
                $usuLn = substr($linea,0,strpos($linea,";"));
                if ($usuario == $usuLn) {
                    $passLn = substr($linea,strpos($linea,";")+1);
                    if ($password == $passLn) {
                        fclose($fichero);
                        echo "este";
                        return 2;
                    }
                    fclose($fichero);
                    return 1;
                }
            }
            fclose($fichero);
            return 0;
        }

        if (login()==2) {
            session_start();
            $_SESSION['loged'] = $_POST['usuario'];
            header("Location: charla.php");
        } elseif (login()==1) {
            header("Location: login.php?usuario=" . $_POST['usuario']);
        } elseif (login()==0) {
            header("Location: alta.php");
        }
    ?>
</body>
</html>