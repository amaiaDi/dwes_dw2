<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <p><strong>1- Fecha actual con formato (diaTH Mes Año, DiaDeLaSemana)</strong></p>
    <?php echo date('d\t\h F Y \, l');?>

    <p><strong>2- Mostrar días restantes para fin de año</strong> </p>
    <?php $hoy= new DateTime(date('d-m-Y'));
           $finano= new DateTime("31-12-2022");
           $diff = $hoy->diff($finano);
           echo $diff->days.' dias';
    ?>

    <p><strong>3- Concatenar cadena en basea a palabras del array</strong></p>
    <?php 
    $semana = [
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sábado',
        'Domingo'
    ];
    echo ($semana[0]." ".$semana[2]);
    ?>

    <p><strong>4- Reemplazar "ñ" por "gn"</strong></p>
    <?php
    $reemplazar = str_replace("ñ", "gn", "El muñeko es ñoño que pasa");
    echo($reemplazar);
    ?>

    <p><strong>5- Función que devuelve un array con n números aleatorios entre limite1 y limite2</strong></p>
    <?php
    function arrayNumerosAleatorios ($n, $limite1, $limite2){
        $array;
        for ($i = 0; $i < $n; $i++) {
            $array[$i]=rand($limite1,$limite2);
        }
        return $array;
    }
    $arr= arrayNumerosAleatorios(5, 1, 20);
    for($j=0;$j<sizeof($arr);$j++){
            echo $arr[$j]."<br>";
        }
    ?>

     <p><strong>6-Función que recibe una cadena y la devuelve cifrada.</strong></p>
     <?php

    const CIFRADO = array("A"=>"platano","B"=>"875", "C"=>"español", "D"=>"gol", "E"=>"ggfdg4", "F"=>"cucu",
    "G"=>"ftp", "H"=>"botella", "I"=>"salchicha", "J"=>"5", "K"=>"tupla", "L"=>"99", "M"=>"h69", "N"=>"domino",
    "Ñ"=>"333", "O"=>"222", "P"=>"txipiron", "Q"=>"9y3r8", "R"=>"tecallas", "S"=>"porperro", "T"=>"asegunda", "U"=>"cmurio",
    "V"=>"f43", "W"=>"el", "X"=>"xxx", "Y"=>"elbicho", "Z"=>"suuuuuiuiuu");

    function cifrarCadena($cadena){
        $cadena=strtoupper($cadena);
        global $nuevaCadena;
        for($i=0; $i<strlen($cadena);$i++){
            foreach (CIFRADO as $izquierda => $derecha){
                if($cadena[$i]==$izquierda){
                    $nuevaCadena.=$derecha;
                    break;
                }
            }
        }
        return $nuevaCadena;
    }
        $pruebacifrado = cifrarCadena("AC");
        echo $pruebacifrado . "<br>"
     ?>

</body>
</html>