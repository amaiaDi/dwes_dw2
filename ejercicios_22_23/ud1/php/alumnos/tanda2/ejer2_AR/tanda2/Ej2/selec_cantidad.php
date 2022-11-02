<?php
 
    function contarImg (){
        $arrext=["jpg","png","tiff","jpeg","gif"];
        $n = 0;
        $directories=scandir('./');
        foreach($directories as $dir){
            if(is_dir($dir) && $dir == "images"){
                $urlDir='./'.$dir;
                $files=scandir($urlDir);
                foreach($files as $f){
                    $ext = pathinfo($f, PATHINFO_EXTENSION);
                    if(in_array($ext, $arrext))
                    {
                        $n++;
                    }
                }
            }
        }
        return $n;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantidad</title>
</head>
<body>
    <form enctype="multipart/form-data" action="./php/eval_imag.php" method="post">
        <label for="selCantidad">¿Cuántas imágenes deseas ver?</label>
        <select name="selCantidad" id="selCantidad">
            <?php
                $numImg = contarImg();
                for ($cont = 2; $cont <= $numImg; $cont++){
                    echo "<option>".$cont."</option>";
                }
                
            ?>
        </select>
        <input type="submit" name="verImg" value="VER IMÁGENES">
    </form>
</body>
</html>