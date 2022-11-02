<?php
    $fp = fopen('ficheros/usuarios.txt', "r");
    $arrUsuarios;
    $linea;
    $cont = 0;
    while (!feof($fp))
    {
        $linea = fgets($fp);
        $arrUsuarios[$cont] = explode(';', $linea);
        $cont++;
    }
    fclose($fp);
    print_r($arrUsuarios);

    $usuario = $_POST['user'];
    $password = $_POST['password'];
    $sw = false;
    for($c = 0; $c < count($arrUsuarios); $c++)
    {
        if($usuario == trim($arrUsuarios[$c][0]) && $password == trim($arrUsuarios[$c][1]))
        {
            header("Location: charla.php?username=$usuario");
            exit();
        }
    }
    for($c = 0; $c < count($arrUsuarios); $c++)
    {
        if($usuario == trim($arrUsuarios[$c][0]) && $password != trim($arrUsuarios[$c][1]))
        {
            header("Location: login.php?username=$usuario");
            exit();
        }
    }
    $arrUsuarios = serialize($arrUsuarios);
    $arrUsuarios = urlencode($arrUsuarios);
    header("Location: alta.php?arrUsuarios=$arrUsuarios");
    exit();
?>