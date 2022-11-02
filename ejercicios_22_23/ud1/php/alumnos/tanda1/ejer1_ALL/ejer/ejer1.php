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
        //o	Muestra la fecha actual con el formato:    17th  September 2021, Wednesday
        echo date('jS  F Y l ');
        echo ("</br>");

         //o	Muestra cuántos días quedan para finalizar el año
        $fecha = "1-01-2023";
        $fechahoy =  date("Y-m-d");
        $resta = strtotime($fecha)-strtotime($fechahoy);
        $dias = $resta / (24*3600);
        echo "diferencia en dias: ".$dias;
        echo ("</br>");

        //o	Crea una cadena/frase a partir de los elementos de un array de palabras y la visualiza.
        $array= [
             "HOLA",
             ' ',
             "MAMA"
        ];
        echo($array[0].$array[1].$array[2]);
        echo ("</br>");

        //o	A partir de una cadena con eñes, crea y visualiza otra que reemplace las eñes por “gn”
        echo str_replace("ñ","gn","anañin");
        echo ("</br>");  


        //o	Función que devuelve un array con n números aleatorios entre limite1 y limite2 (n, limite1, limite2 son parámetros de la función)
                
        function devuelveArray($n,$limite1,$limite2){
            $n ="3";
            $limite1="12";
            $limite2="25";
            $array1= array();
            for ($i = 0; $i < $n; $i++) {
            $d=rand($limite1,$limite2);
            $array1[$i]=$d;
            
            }
            return $array1;


        }
        echo implode(" ",devuelveArray("3","12","25"));
        echo("<br>");

        //o	Función que recibe una cadena y la devuelve cifrada.Para saber cómo cifrar cada letra, utiliza un array constante asociativo que tiene como claves los caracteres y como valores sus cifrados.Por ejemplo, dado el array de cifrado [“A”=>”20”, “H”=>”9R”, “M”=>”abcd”], la cadena “HOLA AMO”, se cifraría como “9ROL20 20abcdo”
        const array2 = array("A" => "1,", "B" => "2,","C" => "3,","D" => "4,","E"=> "5,","F" => "6,","G" => "7,","H" => "8,","I" => "9,","J" => "10,","K" => "11,","L" => "12,","M" => "13,","N" => "14,","Ñ" => "15,","O" => "16,","P" => "17,","Q" => "18,","R" => "19,","S" => "20,","T" => "21,","U" => "22,","V" => "23,","W" => "24,","X" => "25,","Y" => "26,","Z" => "27,");

        function cifrado($cadena){
            $npalabra=" ";
               
            for ($i=0; $i < strlen($cadena) ; $i++) { 
                foreach (array2 as $clave => $valor) {
                    if ($cadena[$i]==$clave) {
                        //echo($clave);echo("..");echo($valor);echo("<br>");
                        $npalabra=$npalabra.$valor;
                    }
                }
            }
                
            
            return $npalabra;


        }
        
        echo(cifrado("VITORIA"));
        echo("<br>");


        //prueba
        /*
        function cifrado($cadena){
            $cadena = "VITORIA";
            $arr1 = str_split($cadena);
            $array3= array();
            for ($i=0; $i < sizeof($arr1) ; $i++) { 
                foreach (array2 as $clave => $valor) {
                    if ($arr1[$i]==$clave) {
                        
                        $array3[$i]=$valor;
                    }
                }
            }
                
            
            return $array3;


        }
        echo(cifrado());
        */
        

    ?>
        
    
   
</body>
</html>