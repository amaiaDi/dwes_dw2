<?php

    if (isset($_POST['entrar'])) {
        
        $encontrado = false;
        $mensaje = '';

        if (!empty($_POST['nombre']) && !empty($_POST['password'])) {
            $file = fopen("usuarios.txt", "r");
            while(!feof($file)) {
                $linea = fgets($file);
                $datos = explode(';', $linea);
                if (in_array($_POST['nombre'], $datos) && strcmp($_POST['password'], $datos[1]) === 0) {
                    $encontrado = true;
                }
                
                if (in_array($_POST['nombre'], $datos) && strcmp($_POST['password'], $datos[1]) !== 0) {
                    header('Location: login.php?encontrado=' . false . '&usuario=' . $_POST['nombre']);
                    exit();
                }
            }
            fclose($file);

            if ($encontrado) {
                header('Location: login.php?encontrado=' . true);
            } else {
                header('Location: alta.php?');
            }
        } else {
            header('Location: login.php');
            exit();
        }
    }
?>