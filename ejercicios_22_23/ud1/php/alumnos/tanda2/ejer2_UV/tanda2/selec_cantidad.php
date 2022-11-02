<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>selec_cantidad</title>
</head>
<body>
    <form action="eval_imag.php" method="POST">
        <label for="cant">¿Cuántas imágenes desea ver?</label>
        <?php
            function cuantasImag($carpeta)
            {
                $arrext = array("jpg", "png", "tiff");
                $cont = 0;
                $dir = opendir($carpeta);
                for($i=0; $archivo = readdir($dir);$i++)
                {
                    for($i1=0;$i1<count($arrext);$i1++)
                    {
                        if(substr($archivo, strpos($archivo, ".")+1) == $arrext[$i1])
                        {
                            $cont++;
                        }
                    }

                }
                return $cont;
            }
            $cont = cuantasImag("DIRIMG");
            echo "<select id='cantidad' name='cantidadImg'>";
            for($i=2;$i<$cont+1;$i++)
            {
                echo "<option value='$i'>$i</option>";
            }
            echo"</select>";
        ?>
        <br>
        <br>
        <button type="submit" name="enviar">VER IMAGENES</button>
    </form>

</body>
</html>