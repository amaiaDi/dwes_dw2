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
        //Mostrar fecha actual
        echo(date('dS F Y l'));
        echo("<br>");
        //Cuantos dias quedan para finalizar el año
        $diasQuedan = 365 - date("z");
        echo "Quedan $diasQuedan dias para finalizar el año";
        echo("<br>");
        //Crear cadena/frase a partir de un array de palabras
        $arrPalabras = array("hola","que","tal");
        $palabrasConcatenadas = $arrPalabras[0];
        $palabrasConcatenadas = $palabrasConcatenadas." ".$arrPalabras[1];
        $palabrasConcatenadas = $palabrasConcatenadas." ".$arrPalabras[2];
        echo $palabrasConcatenadas;
        echo("<br>");
        //Funcion que devuelve un array con n numeros aleatorios entre limite1 y limite2
        function cambiarLetra(){
            echo str_replace ("ñ" , "gn", "ñañaña");
        }
        echo cambiarLetra();
        echo("<br>");
        //funcion que devuelve un array con n numeros aleatorios entre limite1 y limite2
        function aleatorios(){
            $n = 3;
            $limite1 = 1;
            $limite2 = 10;
            $arrayNumsAle = array();
            for ($i=0; $i < $n; $i++) { 
                $numAle = rand($limite1, $limite2);
                $arrayNumsAle[$i] = $numAle;
            }
            return $arrayNumsAle;
        }
        echo implode(" ",aleatorios());
        echo("<br>");
        //funcion que recibe una cadena y la devuelve cifrada
        const CIFRADO = array("A"=>"1", "B"=>"2","C"=>"3","D"=>"4","E"=>"5","F"=>"6","G"=>"7","H"=>"8","I"=>"9","J"=>"10","K"=>"11","L"=>"12", "M"=>"13","N"=>"14","O"=>"15","P"=>"16","Q"=>"17","R"=>"18","S"=>"19","T"=>"20","U"=>"21","V"=>"22","W"=>"23","X"=>"24","Y"=>"25","Z"=>"26");
        function cifrada($cadena){
            $nuevaPalabra = "";
            for ($i=0; $i < strlen($cadena) ; $i++) {
                foreach (CIFRADO as $clave => $valor){
                    if($cadena[$i] == $clave){
                        $nuevaPalabra = $nuevaPalabra.$valor;
                    }
                }   
            }
            echo($nuevaPalabra);
        }
        cifrada("HOLA");
     ?>
</body>
</html>