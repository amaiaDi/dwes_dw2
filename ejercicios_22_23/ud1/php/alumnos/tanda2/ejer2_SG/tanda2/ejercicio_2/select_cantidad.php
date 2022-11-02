<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <main>
        <?php
            define("DIRIMG","../DIRIMG");
            function cuantasImag($carpeta){
                $arrext=array("jpg","png","tiff","webp");
                $gestor = opendir($carpeta); 
                $imagenes = array();
                $i = 0;
                while (($archivo = readdir($gestor)) !== false)  {
                    if ($archivo != "." && $archivo != "..") {
                        $esImg = false;
                        for ($j=0; $j < count($arrext); $j++) {
                            $ext = substr($archivo,strrpos($archivo,".")+1); 
                            if($arrext[$j] == $ext){
                                $esImg = true;
                                break;
                            }
                        }
                        if($esImg){
                            $imagenes[$i] = $carpeta . "/". $archivo;
                            $i++;
                        }
                    }
                }
                session_start();
                $_SESSION['array'] = $imagenes;
                return count($imagenes);
            }
            $cant_img = cuantasImag(DIRIMG);
        ?>
        <form action="eval_imag.php" method="post">
            <label for="cantidad_img">¿Cuantas imagenes deseas ver?</label>
            <input type="number" name="cantidad_img" id="cantidad_img" size="<?php echo $cant_img ?>"
            min="2" max="<?php echo $cant_img ?>"><br>
            <input type="submit" value="VER IMAGENES">
        </form>
    </main>
</body>
</html>