<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cifrador de cadenas</title>
</head>
<body>
    <?php 

    function cifradoCesar($texto,$desplazamiento){
        $texto_cifrado = "";
        $a = substr($texto,0,1);
        echo "";
        for($i=0; $i<strlen($texto);$i++){
            $pos = ord(substr($texto,$i,1))+$desplazamiento;
            if($pos > ord('Z')){
                $pos -= 26;
            }
            $texto_cifrado .= chr($pos);
        }
        return $texto_cifrado;
    }

    function cifradoSustitucion($texto, $abc, $clave){
        $texto_cifrado="";
        for($i=0; $i<strlen($texto); $i++){
            $letra = substr($texto,$i,1);
            $posicion = strpos($abc,$letra);
            $texto_cifrado .= substr($clave,$posicion,1);
        }
        return $texto_cifrado;
    }

    function leerArchivoLinea($ruta_archivo){
        $archivo = fopen($ruta_archivo,"r");
        while(!feof($archivo)){
            $linea = fgets($archivo);
        }
        fclose($archivo);
        return $linea;
    }

        $arr_cesar = array(3,5,10);
        $arr_archivos = scandir("archivos_cifrado");
        $alfabeto = $arr_archivos[2];
        $arr_archivos = array_slice($arr_archivos,3);     
    ?>
    <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
    <?php
        echo "Texto a cifrar:   <input type='texto' name='texto_a_cifrar'><br/><br/>";
        echo "Desplazamiento: <br>";
        foreach($arr_cesar as $ac){
            echo "<input type='radio' name='cesar' value='$ac'> $ac";
        }
        echo "<br><input type='submit' value='CIFRADO CESAR' name='btn_cesar'><br/>";
        echo "           <br><label for='fich_clave'>Fichero de clave:  </label>
        <select name='fich_clave'>";
        foreach($arr_archivos as $aa){
            echo "<option value='archivos_cifrado/$aa'>$aa</option>";
        }
        echo "</select>   <input type='submit' value='CIFRADO POR SUSTITUCIÓN' name='btn_sustitucion'> ";
        echo "</form>";
    ?>

    <?php 
    $errores = array();

    if(isset($_POST["btn_cesar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["texto_a_cifrar"])){
            $errores [] = "El texto está vacío.";
        }
        if(empty($_POST["cesar"])){
            $errores [] = "No se elegido ningún cifrado.";
        }

        if(empty($errores)){
            $texto = $_POST['texto_a_cifrar'];
            $texto = strtoupper($texto);
            $desplaza_elegido = $_POST['cesar'];
        }

        if(count($errores) > 0){
            foreach($errores as $error){
                echo "<p>$error</p>";
            }
        }
        else{
            $texto_cifrado = cifradoCesar($texto,$desplaza_elegido);
            echo "<p>Texto cifrado:  $texto_cifrado </p>";
        }

    }
    
    if(isset($_POST["btn_sustitucion"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['texto_a_cifrar'])){
            echo "<br>El texto está vacío.";
        }
        else{
            $texto = $_POST['texto_a_cifrar'];
            $texto = strtoupper($texto);
            $ruta_archivo = $_POST['fich_clave'];
            $linea = leerArchivoLinea($ruta_archivo);
            $abecedario = leerArchivoLinea("archivos_cifrado\abecedario.txt");
            $cifrado = cifradoSustitucion($texto,$abecedario,$linea);
            echo "<p>Texto cifrado: $cifrado </p>";
        }
    }
    ?>

</body>
</html>





