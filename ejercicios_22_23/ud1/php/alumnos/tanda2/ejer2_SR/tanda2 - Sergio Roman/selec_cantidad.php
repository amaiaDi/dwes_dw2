<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>selec_cantidad</title>
</head>
<body>
    <form action="eval_imag.php" method="post">
        <label for="text">¿Cuantas imagenes deseas ver?</label>
        <?php
            function cuantasImg($direc)
            {  
                $arrext = ["jpg", "png", "tiff"];
                $dir = opendir($direc);
                $cont = 0;
                for($c = 0; $elemento = readdir($dir); $c++)
                {
                    for($i = 0; $i < count($arrext); $i++)
                    {
                        if(substr($elemento, strpos($elemento, ".")+1) == $arrext[$i])
                        {
                            $cont++;
                            break;
                        }
                    }
                }
                return $cont;
            };
            $cont = cuantasImg("DIRIMG");
            echo "<select name='cmb' id='cmbImg'>";
            for($c = 2; $c < $cont+1; $c++)
            {
                echo "<option value='$c'>$c</option>";
            }
            echo "</select>";
        ?>
        <br>
        <br>
        <button type="submit" name="enviar">VER IMAGENES</button>
    </form>
</body>
</html>