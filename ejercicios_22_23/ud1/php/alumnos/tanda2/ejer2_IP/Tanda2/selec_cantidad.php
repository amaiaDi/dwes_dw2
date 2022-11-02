<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
        //Constante la ruta de la carpeta de imágenes
        const DIRIMG = "DIRIMG/";
        function cuantasImag(){
            //Array para guardar el tipo de extensiones que queremos permitir
            $arrext = array("jpg","png","tiff");
            $cont = 0;
            $string = "";
            //Guardarmos en $dir la carpeta
            $dir = opendir(DIRIMG);
                //Mientras queden elementos por leer
                while ($elemento = readdir($dir)){
                    // Tratamos los elementos . y .. que tienen todas las carpetas
                    if( $elemento != "." && $elemento != ".."){
                        //Verificamos si la extensión existe en el array, de ser así se añadirá 1 al contador
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
            ¿Cuantas imagenes deseas ver?       
            <select name="cantImagenes">
                <?php echo cuantasImag(); ?>
            </select><br>
        <input type="submit" value="VER IMAGENES" name="enviarCantidad"/>
         </form>
    </body>
</html>