<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrador de cadenas</title>
</head>
<body>
    <form action="<?php ($_SERVER["PHP_SELF"]);?>" method="post">
    <?php
        echo "<label for='texto'>Texto a cifrar</label>
            <input type='text' name='cifrar'>
            <br/>
            <br/>
            <label for='desplazamiento'>Desplazamiento</label>
        ";
        $arrayDesp = [3, 5, 10];
        for($c = 0; $c < count($arrayDesp); $c++)
        {
            echo "<input type='radio' name='radio' value='radio$c'>
                <label for='radioNum'>$arrayDesp[$c]</label>";
        }
        echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='enviar' value='CIFRADO CESAR'><br/><br/>
            <label for='ficheo'>Fichero de clave</label>
            <select id='lista' name='opcion'>";

            $dir = opendir("ficheros");
            $arrayFich;
            for($c = 0; $elemento = readdir($dir);  $c++)
            {
                if( $elemento != "." && $elemento != "..")
                {
                    $arrayFich[$c] = $elemento;
                    echo "<option value='opcion$c'>$elemento</option>";
                }
                else
                {
                    $c--;
                }
            }
            echo "</select>
            &nbsp;&nbsp;&nbsp;<input type='submit' name='enviar1' value='CIFRADO POR SUSTITUCION'><br/><br/>";
        
        echo "</form>";

        if (isset($_POST['enviar']))
        {
            $sw = true;
            if(empty($_POST['cifrar']))
            {
                $sw = false;
                echo "Debese introducir un texto <br>";
            }
            else
            {
                $textoCifrar = $_POST['cifrar'];
                $textoCifrar = strtoupper($textoCifrar);
            }
            if(empty($_POST['radio']))
            {
                echo "Debes indicar un desplazamiento";
            }
            else
            {
                for($i = 0; $i < count($arrayDesp); $i++)
                {
                    if($_POST['radio'] == "radio$i")
                    {
                        $numeroDesplaza = $arrayDesp[$i];
                    }
                }
                $textoCifrado = '';
                if($sw == true)
                {
                    for($c = 0; $c < strlen($textoCifrar); $c++)
                    {
                        $num = ord($textoCifrar[$c]);
                        $numN = $num+$numeroDesplaza;
                        if($numN > 90 )
                        {
                            $numN = 65 + ($numeroDesplaza - (91 - $num));
                        }
                        $numNuevo = chr($numN);
                        $textoCifrado = $textoCifrado . $numNuevo;
                    }
                    echo "<strong>Texto Cifrado: $textoCifrado</strong>";
                }
            }
        }
        if (isset($_POST['enviar1']))
        {
            if(empty($_POST['cifrar']))
            {
                echo "Debese introducir un texto <br>";
            }
            else
            {
                for($i = 0; $i < count($arrayFich); $i++)
                {
                    if($_POST['opcion'] == "opcion$i")
                    {
                        $nomFich = $arrayFich[$i];
                    }
                }
            $fp = fopen('ficheros/'.$nomFich, "r");

            $linea;
            while (!feof($fp))
            {
                $linea = fgets($fp);
            }
            fclose($fp);

            $textoCifrar = $_POST['cifrar'];
            $textoCifrar = strtoupper($textoCifrar);
            $textoCifrado = '';
            for($c = 0; $c < strlen($textoCifrar); $c++)
            {
                $num = ord($textoCifrar[$c]);
                $num = $num - 65;
                $textoCifrado = $textoCifrado . $linea[$num];
            }
            echo "<strong>Texto Cifrado: $textoCifrado</strong>";
            }
        }
    ?>
</body>
</html>