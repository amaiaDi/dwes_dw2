<!-- Página con un formulario que se envía a sí misma
Consiste en introducir un texto y deducir su correspondiente texto cifrado de uno de los 2 siguientes modos:
•	Cifrado César, indicando el desplazamiento (3,5, 10 son valores de un array)
•	Cifrado por sustitución, eligiendo en base a qué fichero se realizarán las sustituciones (los ficheros que se muestran en el combo son todos los existentes en una carpeta constante del proyecto) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1: Cifrador de cadenas</title>
</head>
<body>
    <h1>Ejercicio 1: Cifrador de cadenas</h1>
   <?php

    $arrayAbecedario=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $arrayCifradoSustitucion; $arrayCifradoCesar;
    $textoACifrar="";
    $errorTextACifrar="";
    $errorRadioDesplazamiento="";
    $numeroCifrado="";
    $resultado="";


    //-metodo para obtener el listado de ficheros a mostrar por pantalla
    function fncObtenerListadoFicheros($ruta){
        if (is_dir($ruta)){
            $gestor = opendir($ruta);

             // R4ecorre todos los elementos del directorio
            while (($archivo = readdir($gestor)) !== false)  {
                if ($archivo != "." && $archivo != "..") {
                    echo  "<option value='$archivo'>$archivo</option>";
                }
            }
        }
    }

    //Metodo para obtener el Cifrado cesar en base al desplazamiento seleccionado
    function fncCifradoCesar(){
        global $textoACifrar,$resultado,$arrayCifradoCesar,$arrayAbecedario;
        $resultado=$textoACifrar;
        $contar=0;

        fncObtenerArrayCifradoCesar();

        for($i=0;$i<strlen($textoACifrar); $i++){
            $resultado[$i]=$arrayCifradoCesar[$textoACifrar[$i]];
        }
    }

    //Metodo para obtener el cifraado de sustitucion ebn base a la cadena en los ficheros
    function fncCifradoSustitucion(){

        global $textoACifrar,$resultado,$arrayCifradoSustitucion;
        $resultado=$textoACifrar;

        fncObtenerArrayCifradoSustitucion($_POST['fichero']);
        for($i=0;$i<strlen($textoACifrar); $i++){
            $resultado[$i]=$arrayCifradoSustitucion[$textoACifrar[$i]];
        }
       
    }

    //Metodo para obtener el array de sustitución en base a la opcion de desplazamiento eleccionado
    function fncObtenerArrayCifradoCesar(){
        global $arrayCifradoCesar,$arrayAbecedario,$numeroCifrado;
        $contar=0;

        while ($count<count($arrayAbecedario)){
            
            if($contar<$contar+$numeroCifrado){
                $arrayCifradoCesar[$contar]=$arrayAbecedario[$contar+$numeroCifrado];
            }else{
                ////TODO - PENDIENTE DE CORREGIR EL CIFRADO 
                $arrayCifradoCesar[$contar]=$arrayCifradoSustitucion[$textoACifrar[$i]];
            }
        }
    }

    //Metodo para obtener el array de sustitución en base a la cadena del fichero seleccionado y al array con el abecedario
    function fncObtenerArrayCifradoSustitucion($fichero){

        global $arrayAbecedario,$arrayCifradoSustitucion;
        $linea;
           
        //Apertura de fichero en modo lectura
        $punteroLectura = fopen('./ficheros/'.$fichero, 'r');
        if(!$punteroLectura){
        echo 'No se puede abrir el fichero.'; exit();
        }
        //lectura del contenido del fichero, en este caso linea con clave de codificacion
        while(!feof($punteroLectura)){
            $linea=fgets($punteroLectura);
        }
        fclose($punteroLectura);

        //Recorremos el contenido de la linea para 
        for ($i=0;$i<strlen($linea);$i++){
             $arrayCifradoSustitucion[$arrayAbecedario[$i]] =$linea[$i];
        }
    }

    //comprobamos si la petición ha sido devuelta del botón cifradoCesar o del boton cifradoPorSustitucion
    if (isset($_POST['cifradoCesar']) || isset($_POST['cifradoPorSustitucion']) ) 
    {
        // Verificar si el texto a cifrar viene relleno y si no mostramos mensaje de error
        if (empty($_POST['textoACifrar'])){
            $errorTextACifrar="Debes introducir texto a cifrar";
        }else{
            $textoACifrar=$_POST['textoACifrar'];
        }

        //Validamos si el campo de cifrado viene relleno y si no mostramos mensaje de error
        if (empty($_POST['cifrado']) && isset($_POST['cifradoCesar'])){
            $errorRadioDesplazamiento="Debes seleccionar una opción de desplazamiento";
        }else{
                $numeroCifrado=$numeroCifrado;
        }

        //TODO - PENDIENTE CARGAR EL FICHERO SELECCIONADO

        if (empty($errorTextACifrar) && empty($errorRadioDesplazamiento) && isset($_POST['cifradoPorCesar'])){

            fncCifradoCesar();

        }elseif(empty($errorTextACifrar)  && isset($_POST['cifradoPorSustitucion'])){
            fncCifradoSustitucion();
    
        }
    }
    ?>
    <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td >Texto a cifrar:</td>
                <td colspan="2">
                    <input type="text" name="textoACifrar" value="<?php echo $textoACifrar?>"/>
                </td>
                <td>
                    <?php echo $errorTextACifrar ?>
                </td>
            </tr>
            <tr>
                <td>Desplazamiento</td>
                <td>
                    <input type="radio" name="cifrado" id="3" value="3" <?php if(!empty($numeroCifrado) && $numeroCifrado==3) echo 'checked'?>>3</input>
                    <input type="radio" name="cifrado" id="5" value="5" <?php if(!empty($numeroCifrado) && $numeroCifrado==5) echo 'checked'?>>5</input>
                    <input type="radio" name="cifrado" id="10" value="10" <?php if(!empty($numeroCifrado) && $numeroCifrado==10) echo 'checked'?>>10</input>
                </td>
                <td>
                    <input type="submit" value="CIFRADO CESAR" name="cifradoCesar"/>
                </td>
                <td><?php echo $errorRadioDesplazamiento ?></td>
            </tr>
            <tr>
                <td>Fichero de clave</td>
                <td>
                <select name="fichero">
                    <?php echo fncObtenerListadoFicheros('./ficheros');?>
                </select> <br>

                </td>
                <td>
                    <input type="submit" value="CIFRADO POR SUSTITUCION" name="cifradoPorSustitucion"/>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <?php if(!empty($resultado)) echo '<b>Texto Cifrado:'.$resultado.'</b>'?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>