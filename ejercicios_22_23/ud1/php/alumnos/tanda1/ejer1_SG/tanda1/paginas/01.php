<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <main>
        <?php 
            //Muestra la fecha actual con el formato
            echo date("dS F Y, l") ."<br/>"  ;

            //o	Muestra cuántos días quedan para finalizar el año
            $dia = date("z") +1;
            if (date("L") == 0) {
                $dia = 365 - $dia;
            }else{
                $dia = 366 - $dia;
            }
            echo "Faltan " . $dia . " dias para que el año termine. <br/>" ;
            //Crea una cadena/frase a partir de los elementos de un array de palabras y la visualiza.
            $arr = array("hola","que","tal","estas?");
            foreach ($arr as $palabra) {
                echo $palabra ." ";
            }
            echo "<br/>";

            //A partir de una cadena con eñes, crea y visualiza otra que reemplace las eñes por “gn”
            $str = 'alimaña piña añadir extraño español dueño';
            $nuevo_str = str_replace("ñ","gn",$str);
            echo $nuevo_str . "<br />";

            //o	Función que devuelve un array con n números aleatorios entre limite1 y limite2
            //(n, limite1, limite2 son parámetros de la función)
            function numsRandoms( $n,$limite1,$limite2){
                if($limite2 <$limite1)
                {
                    $aux = $limite2;
                    $limite2 = $limite1;
                    $limite1 = $aux;
                }
                $count = 1;
                $arr2;
                while ($count <= $n) {
                    $numRandom = random_int($limite1,$limite2);
                    $arr2[$count-1] =  $numRandom ;
                    $count++;
                }
                return $arr2;
            }
            $arr3 = numsRandoms(5,20,30);
            foreach ($arr3 as $num) {
                echo $num . " ";
            }
            echo "<br/>";
            //Función que recibe una cadena y la devuelve cifrada.
            function cifrarMensaje($string){
                $arr = array("A"=>"20","H"=>"9R","M"=>"abcd");
                $str_cifrado = "";
                for ($i=0; $i < strlen($string); $i++) { 
                    $car = substr($string,$i,1);
                    $iguales = false;
                    foreach ($arr as $letra => $codificacion) {
                        if(strcmp($car,$letra)==0){
                            $str_cifrado = $str_cifrado . $codificacion;
                            $iguales = true;
                            break;
                        }
                    }
                    if($iguales == false)
                        $str_cifrado = $str_cifrado . $car;      
                }
                return $str_cifrado;
            }
            echo cifrarMensaje("HOLA AMO");
        ?>
    </main>
</body>
</html>