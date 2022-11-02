<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 
            $array = array("3","5","10");
            $errores=array();  
            $errorTexto = ""; 
            $texto = "";
            $errorElegirNumero = "";
            $resultado = "";

            //Comprobamos si se ha pulsado alguno de los 2 botones
            if ((isset($_POST["botonCesar"]) || isset($_POST["botonSustitucion"])) && $_SERVER["REQUEST_METHOD"] == "POST"){   
                $texto = $_POST["texto"]; 
                //comprobar que el campo de texto no esta vacio
                if(empty($texto)){
                    $errorTexto = "El texto es requerido";
                }
                //comprobar que se ha seleccionado algun radio
                if(empty($_POST["elegirNumero"])){
                    $errorElegirNumero = "No se ha seleccionado ningun desplazamiento";
                }else{
                    $valorElegirnumero = $_POST["elegirNumero"];
                }
                //hacer metodo boton cesar solo si el texto no esta vacio y si se ha elegido algun radio
                if(isset($_POST["botonCesar"]) && !empty($texto) && !empty($valorElegirnumero)){
                        $texto = strtoupper($texto);
                        $resultado = botonCesar($texto, $valorElegirnumero);
                }
                //hacer metodo sustitucion solo si el texto no esta vacio
                $fichero = $_POST["ficheros"];
                if(isset($_POST["botonSustitucion"]) && !empty($texto)){
                    $resultado = botonSustitucion($fichero, $texto);
                }
            }
            
            function botonCesar($palabra, $numPosicion){
                $nuevaPalabra = "";
                while(strlen($palabra)>0){
                    if((ord($palabra[0])) + $numPosicion>90){
                        $nuevaPalabra = $nuevaPalabra.chr((ord($palabra[0])) + $numPosicion - 26);
                    }else{
                        $nuevaPalabra = $nuevaPalabra.chr((ord($palabra[0])) + $numPosicion);
                    }
                    $palabra = substr($palabra, 1);
                }
                return $nuevaPalabra;
            }

            function botonSustitucion($nomFich, $texto){
                //Leer el fichero
                $fichero = fopen ("ficheros/$nomFich", "r");
                $contenido_Fichero = fread($fichero, filesize("ficheros/$nomFich"));
                //
                $texto = strtolower($texto);
                $resultado = "";
                for($i=0 ; $i < strlen($texto) ; $i++){
                    $pos = ord($texto[$i])-96;
                    $resultado = $resultado.$contenido_Fichero[$pos-1];
                }
                return $resultado;
            }

            function leerFicheros(){
                $string = "";
                $dir = opendir("ficheros/");
                while ($elemento = readdir($dir)){
                    // Tratamos los elementos . y .. que tienen todas las carpetas
                    if( $elemento != "." && $elemento != ".."){
                        $string = $string."<option value='$elemento'>$elemento</option>";
                    }
                }
                return $string;
            }
            
            function desplazamiento(){
                global $array;
                for($i=0;$i<sizeof($array);$i++){
                    echo "<input type='radio' name='elegirNumero' value=$array[$i] ";
                    if(!empty($valorElegirnumero) && $array[0] == $valorElegirnumero){ echo 'checked';}
                    echo "> $array[$i] </input>";
                }
            }


        ?>       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            Texto a cifrar:
            <input type="text" name="texto" value="<?php echo $texto?>">
            <?php echo $errorTexto ?><br>

            Desplazamiento:             
            <?php echo desplazamiento();?>

            <input type="submit" value="CIFRADO CESAR" name="botonCesar"/>
            <?php echo $errorElegirNumero ?> <br>

            Fichero de clave:                                
            <select name="ficheros">
                <?php echo leerFicheros(); ?>
            </select>

            <input type="submit" value="CIFRADO POR SUSTITUCION" name="botonSustitucion"/><br>

        </form>
        <h2>Texto cifrado : <?php echo $resultado ?></h2>
    </body>
</html>