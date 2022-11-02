<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
        const DIRIMG = "DIRIMG/";
        function cuantasImag(){
            $arrext = array("jpg","png","tiff");
            $cont = 0;
            $string = "";
            $dir = opendir(DIRIMG);
                while ($elemento = readdir($dir)){
                    // Tratamos los elementos . y .. que tienen todas las carpetas
                    if( $elemento != "." && $elemento != ".."){
                        $extension = substr($elemento, stripos($elemento,'.')+1);
                        if(in_array(strtolower($extension), $arrext)){
                            $cont++;
                            $string = $string."<option value='$cont'>$cont</option>";
                        }
                    }
                }
                return $string;
        }
    ?>
    <body>                          
                                    <form action="eval_imag.php"  method="post">
    ¿Cuantas imagenes deseas ver?       <select name="cantImagenes">
                                                <?php echo cuantasImag(); ?>
                                        </select><br>
                                                <input type="submit" value="enviar" name="enviarCantidad"/>
                                    </form>
    </body>
</html>