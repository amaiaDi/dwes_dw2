<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer1</title>
</head>
<body>
    <?php  
    $fechaActual = date('dS F Y, l');
    $diasTotal = 0;
    $array=array("Hola", "mi", "nombre", "es");
    $cadenaDeEnes="nnn";
    $str = str_replace("n", "gn", "hola mi nombre");
    

    function contarDias() {
        $cont=0;
        $dia=date('d'); 
        $mes=date('m');
        while ($mes<13) {
            if ($mes==1||$mes==3||$mes==5||$mes==7||$mes==8||$mes==10||$mes==12) {
                while ($dia<=31) {
                        $cont++;
                        $dia++;
                    }
            }
            else {
                if ($mes==2) {
                    while ($dia<=28) {
                        $cont++;
                        $dia++;
                    }
                }
                else {
                    while ($dia<=30) {
                        $cont++;
                        $dia++;
                    }
                }
            }
            $dia=1;
            $mes++;
        }
        return $cont;
    }
    function numAle($n,$limite1,$limite2){
        $arrayAl=array();
        $cont2=0;
        while ($n>0) {
            $arrayAl[$cont2]=random_int($limite1,$limite2);
            $n--;
            $cont2++;
        }
        return $arrayAl;
    }

    function cifrar($cadena){
        $cadenaCifrada="";
        $arrayCifrado=array("A"=>"20", "H"=>"9R", "M"=>"abcd");
        for ($i=0; $i <strlen($cadena) ; $i++) { 
            $letra=$cadena[$i];
            if (array_key_exists($letra,$arrayCifrado)) {
                $cifrado=$arrayCifrado[$letra];
                $cadenaCifrada="$cadenaCifrada$cifrado";
            }
            else {
                $cadenaCifrada="$cadenaCifrada$letra";
            }
        }
        return $cadenaCifrada;
    }

    $diasTotal=contarDias();
    $frase="$array[0] $array[1] $array[2] $array[3]";
    $arrayAl=numAle(3,1,10);
    $recorrerArray="";
    $longitud2 = count($arrayAl);
    
    for($i=0; $i<$longitud2; $i++){
        $recorrerArray="$recorrerArray $arrayAl[$i], ";
    }
    $cadena="HOLA MUNDO";
    $cadenaCifrada=cifrar($cadena);

    echo "<ul>
        <li>$fechaActual</li>
        <li>$diasTotal</li>
        <li>$frase</li>
        <li>$str</li>
        <li>$recorrerArray</li>
        <li>$cadenaCifrada</li>
    </ul>";    
    ?>
</body>
</html>