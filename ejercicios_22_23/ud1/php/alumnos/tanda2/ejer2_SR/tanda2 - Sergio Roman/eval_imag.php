<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eval_imag</title>
</head>
<body>
    <?php
        if(isset($_POST['enviar']))
        {
            function rutas_imag($direc)
            {
                $cont = 0;
                $arr = [];
                $arrext = ["jpg", "png", "tiff"];
                $dir = opendir($direc);
                for($c = 0; $elemento = readdir($dir); $c++)
                {
                    for($i = 0; $i < count($arrext); $i++)
                    {
                        if(substr($elemento, strpos($elemento, ".")+1) == $arrext[$i])
                        {
                            $arr[$cont] = $direc . '/' . $elemento;
                            $cont++;
                        }
                    }
                }
            return $arr;
            }
            $arr = rutas_imag("DIRIMG");
            $ran = array_rand($arr, $_POST['cmb']);
            ?>    
            <form action="<?php ($_SERVER["PHP_SELF"]);?>" method="post">
            <?php
            $arrLike = [];
            echo "<table>";
            for($c = 0; $c < count($ran); $c ++)
            {
                $nr = $ran[$c];
                echo "<tr>";
                echo "<td><img src='$arr[$nr]' alt='$arr[$nr]' width='300' height='150'></td>";
                $nom = substr($arr[$nr], strpos($arr[$nr], '/')+1);
                echo "<td>
                <input type='checkbox' name='like[]' id='$c' value='$nom'>
                <label for='like'>Me gusta</label>
                </td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<button type='submit' name='enviar1'>ENVIAR VALORACIONES</button>";
            echo "</form>";
        }
        
        if(isset($_POST['enviar1']))
        {

            if(!empty($_POST['like']))
            {
                $arrLike=($_POST['like']);
                echo "<p>Gracias por tu envio</p>";
                $fichero = fopen("ficheros/fichero.txt", "a+");
                $ip = getHostByName(getHostName());
                $linea = $ip;
                for($c = 0; $c < count($arrLike); $c++)
                {
                    $linea = $linea . ' ' . $arrLike[$c];
                }
                fwrite($fichero, $linea);
                fwrite($fichero, "\n");
            }
            else
            {
                echo "<p>Sentimos que no le haya gustado ninguna</p>";
            }
            echo "<a href='selec_cantidad.php'>Volver a la pagina principal</a>";
        }
    ?>
</body>
</html>