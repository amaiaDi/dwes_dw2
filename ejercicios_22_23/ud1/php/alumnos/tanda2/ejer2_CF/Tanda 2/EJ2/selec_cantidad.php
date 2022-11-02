<?php
define("DIR_IMG", "./images/");
define("ARR_EXT", ["jpg", "png", "tiff", "jpeg"]);
$amountOfImages=getAmountOfImages();

function getAmountOfImages()
{
    $result=0;
    $dir_content=scandir(DIR_IMG);
    foreach($dir_content as $content)
    {
        $ext=pathinfo($content, PATHINFO_EXTENSION);
        if(is_file(DIR_IMG.$content) && in_array($ext, ARR_EXT))
            $result++;
    }
    return $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <form enctype="multipart/form-data" action="./lib/eval_imag.php" method="post">
        <label for="n_images">¿Cuántas imágenes deseas ver?</label>    
        <select name="n_images">
            <?php
            $txtHtml="";
            for($n=2; $n<=$amountOfImages; $n++)
                $txtHtml.="<option>$n</option>";
            echo $txtHtml;
            ?>
        </select>
        <br><br>
        <input type="submit" value="VER IMÁGENES" name="show_images"/>
    </form>
</body>
</html>