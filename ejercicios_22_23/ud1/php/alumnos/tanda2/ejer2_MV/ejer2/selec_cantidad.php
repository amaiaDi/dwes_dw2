<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <p>
                ¿Cuantas imagenes deseas ver?
                <select name="num">
                    <?php
                        $ruta="imagenes";
                        $num=cuantasImag($ruta);
                        for ($i=2; $i < $num+1; $i++) { 
                            echo "<option value='$i'>$i</option>";
                        }
                    ?>
                </select>
            </p>
            <input type="submit" value="VER IMAGENES" name="ver">
        </form>
        <?php
            function cuantasImag($ruta){
                $arrext=array(".jpg",".png",".tiff");
                $cont=0;
                $dir = opendir($ruta);
                while ($elemento = readdir($dir)){
                    if( $elemento != "." && $elemento != ".."){
                        $extension=strstr($elemento,".");
                        for ($i=0; $i < count($arrext); $i++) { 
                            if ($extension==$arrext[$i]) {
                                $cont++;
                            }
                        }
                    }
                }
                return $cont;
            }
            if (isset($_POST['ver'])) {
                $numSelec=$_REQUEST['num'];
                $_SESSION['numSelec'] = $numSelec;
                $_SESSION['ruta'] = $ruta;
                $_SESSION['numsTotal'] = $num;
                header("Location: eval_imag.php");
            } 
        ?>
    </body>
</html>