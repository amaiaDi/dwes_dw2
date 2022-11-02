<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01</title>
</head>
<body>
<form action="<?php ($_SERVER["PHP_SELF"]);?>" method="post">
    <?php
    echo "
        <label for='texto'>Texo a cifrar</label>
        <input type='text' name='texto'>
        <br><br>
        <label for='texto'>Desplazamiento</label>
    ";
    $arrDespla = [3, 5, 10];
    for($i=0;$i<count($arrDespla);$i++)
    {
        echo "<input type='radio' name='radio' value='$arrDespla[$i]'>
            <label for='radioNom'>$arrDespla[$i]</label>";
    }
    echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='cesar' value='CIFRADO CESAR'><br><br>
    <label for='fichero'>Fichero de clave</label>
    <select id='ficheros' name='lista'>";
    $ruta = opendir("ficheros");

    for($i=0; $archivo = readdir($ruta);$i++)
    {
        if($archivo != '.' && $archivo!= '..')
        {
            echo "<option value=$archivo>$archivo</option>";
        }
        else
        {
            $i--;
        }
    }
    echo"</select>&nbsp;&nbsp;&nbsp;&nbsp;
    <input type='submit' name='sustitucion' value='CIFRADO POR SUSTITUCION'><br>";
    $textoCifrado='';
    if(isset($_POST['cesar']))
    {
        if(empty($_POST['texto']))
        {
            echo "Texto vacio <br>";
        }
        else
        {
            $texto = strtoupper($_POST['texto']);
        }
        
        if(empty($_POST['radio']))
        {
            echo "Ningún radio elegido al pulsar \"Cifrado Cesar\"";
        }
        else
        {
            
            for($i=0;$i<count($arrDespla);$i++)
            {
                if($_POST['radio']==$arrDespla[$i])
                {
                    $cifrarNumero = $arrDespla[$i];
                }
            }
            
            for($i=0;$i<strlen($texto);$i++)
            {
                $ascii = ord($texto[$i]);
                if(($ascii+$cifrarNumero)>=ord('Z'))
                {
                    $ascii -=26;
                }
                $textoCifrado .= chr($ascii+$cifrarNumero);
            }
            echo "Texto cifrado:$textoCifrado";
        }
    }
    else if(isset($_POST['sustitucion']))
    {
        if(empty($_POST['texto']))
        {
            echo "Texto vacio <br>";
        }
        else
        {
            $texto = strtoupper($_POST['texto']);
            $lista = $_POST['lista'];
            $fp = fopen("ficheros/$lista", "r");
            while(!feof($fp))
            {
                $linea = fgets($fp);
            }
            fclose($fp);

            for($i=0;$i<strlen($texto);$i++)
            {
                $ascii = ord($texto[$i]);
                $ascii-= 64;
                $textoCifrado .= substr($linea, $ascii-1, 1);
            }
            echo "Texto cifrado:$textoCifrado";
        }
    }

    echo "</form>";
    ?>
</body>
</html>