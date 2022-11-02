<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

        // FECHA ACTUAL
        date_default_timezone_set('Europe/Madrid');
        $fechaActual = date('dS F Y, l');
        echo "<p>$fechaActual</p>";
        # 17th  September 2021, Wednesday

        // DIAS HASTA FIN DE AÑO
        $esteAnio = date("Y");
        $fecha1= new DateTime("now");
        $fecha2= new DateTime($esteAnio . "-12-31");
        $diff = $fecha1->diff($fecha2);
        echo $diff->days+1 .' dias';

        
        // FRASE A PARTIR DE ARRAY DE PALABRAS
        $arrPalabras = array("Hola","me","llamo","Paco");
        $frase = '';
        foreach($arrPalabras as $palabra){
            $frase = $frase . $palabra . " ";
        }
        echo "<p>$frase</p>";
          // otra forma con función implode
        $frase1 = implode(' ',$arrPalabras);
        echo "<p>$frase1</p>";
          // otra forma de escribir un string
        print $frase1;


        // REEMPLAZAR EÑES
        $cadena = "Logroño Año Logroño Año Ñoqui";
        $cadena = str_replace("ñ","gn",$cadena);
        $cadena = str_replace("Ñ","Gn",$cadena);
        echo "<p>$cadena</p>";

        //  FUNCIÓN ARRAY N NÚMEROS
        function arrayNumAletorios($cantidad,$comienzo,$fin){
            $arrayNumeros = array();
            for($i=0;$i<$cantidad;$i++){
                $arrayNumeros[$i]=rand($comienzo,$fin);
            }
            return $arrayNumeros;
        }

          // comprobamos la función
          $arrayPrueba = arrayNumAletorios(10,5,15);
          foreach($arrayPrueba as $numero){
            print $numero . "\t";
          }
          print "<br/>";

          // FUNCIÓN QUE CIFRA UNA CADENA
          
          function cifrar($cadena){
            $cadenaCifrada = "";
            $arrayDeCifrado = array("A"=>"20", "H"=>"9R", "M"=>"abcd");

            for($i=0;$i<strlen($cadena);$i++){
              if(array_key_exists($cadena[$i],$arrayDeCifrado)){
                $cadenaCifrada = $cadenaCifrada . $arrayDeCifrado[$cadena[$i]];
              }
              else{
                $cadenaCifrada = $cadenaCifrada . $cadena[$i];
              }
            }
            return $cadenaCifrada;
          }
          $resp = cifrar("HOLA AMO");
          echo "<br/> $resp";
          
    ?>
</body>
</html>

