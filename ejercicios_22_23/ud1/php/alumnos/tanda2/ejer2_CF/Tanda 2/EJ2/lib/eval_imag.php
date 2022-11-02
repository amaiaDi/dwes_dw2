<?php
define("DIR_IMG", "../images/");
define("ARR_EXT", ["jpg", "png", "tiff", "jpeg"]);

if(isset($_POST["send_ratings"]))
{
    if(isset($_POST["ratings"]))
        saveRatings();
}
else if(!isset($_POST["show_images"]) || !isset($_POST["n_images"]))
{
    header("Location: ../selec_cantidad.php");
    exit();
}

function saveRatings()
{
    $ratings=$_POST["ratings"];
    $f=fopen("../files/ratings.txt", "a");
        
    $line="\n".gethostbyname(gethostname()).":\t";
    for($i=0; $i<count($ratings); $i++)
        $line.=$ratings[$i].' ';
    fwrite($f, $line); 

    fclose($f);
}

function getImgPaths()
{
    $n=0;
    $imgPaths=[];
    $dir_content=scandir(DIR_IMG);
    foreach($dir_content as $content)
    {
        $ext=pathinfo($content, PATHINFO_EXTENSION);
        if(is_file(DIR_IMG.$content) && in_array($ext, ARR_EXT))
            $imgPaths[$n++]=DIR_IMG.$content;
    }

    shuffle($imgPaths);
    return $imgPaths;
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
    <?php
    if(isset($_POST["send_ratings"]))
    {
        $txtHtml="";
        if(!isset($_POST["ratings"]))
            $txtHtml.="<p>Sentimos que no le haya gustado ninguna.</p>";
        else
            $txtHtml.="<p>Gracias por tu envío.</p>";
        $txtHtml.="<a href='../selec_cantidad.php'>Página Inicial</a>";
        echo $txtHtml;
    }
    else 
    {
    ?>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <?php
        $imgPaths=getImgPaths();

        $n_images=0;
        if(isset($_POST["n_images"]))
            $n_images=$_POST["n_images"];
            
        $txtHtml="<table>";
        for($i=0; $i<$n_images; $i++)
        {
            $txtHtml.="<tr>";
            $txtHtml.="<td><img src='".$imgPaths[$i]."' width='250' height='200'></td>";
            $txtHtml.="<td><input type='checkbox' name='ratings[]' value='".$imgPaths[$i]."'>";
            $txtHtml.="<label for='ratings'>Me gusta</label></td>";
            $txtHtml.="</tr>";
        }
        $txtHtml.="</table>";
        echo $txtHtml;
        ?>
        <input type="submit" value="ENVIAR VALORACIONES" name="send_ratings">
    </form>
    <?php
    }
    ?>
</body>
</html>