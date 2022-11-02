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

    // 	Muestra la fecha actual con el formato:    17th  September 2021, Wednesday
        echo date('jS F Y, l');
        echo ('<br>');

    // Muestra cuántos días quedan para finalizar el año

        $date1 = date_create();
        $date2 = date_create('2022-12-31');

        $interval = date_diff($date1,$date2);
        echo $interval->format('%R%a días');
        echo ('<br>');

    // Crea una cadena/frase a partir de los elementos de un array de palabras y la visualiza.

        $palabras= array("Hola","Omar,","que tal");
        $frase=implode(" ",$palabras);
        echo $frase;
        echo ('<br>');

    //	A partir de una cadena con eñes, crea y visualiza otra que reemplace las eñes por “gn”

        $f1= "Andereño  Montaña";
        $f2=str_replace("ñ","gn",$f1);
        echo($f2);
        echo ('<br>');

    //	Función que devuelve un array con n números aleatorios entre limite1 y limite2 (n, limite1, limite2 son parámetros de la función)

    function creaArray($num1,$num2,$num){

        $array=array();
        
        for($cont=0;$cont<=$num;$cont++){
            $array[$cont]= rand($num1,$num2);
        }
        return $array;
    }
    echo implode(" ", creaArray(0,10,3));
    
    //  Función que recibe una cadena y la devuelve cifrada. Para saber cómo cifrar cada letra, utiliza un array constante asociativo que tiene como claves los caracteres y como valores sus cifrados.

        function cifrar($cadena){
            $cifrado=array('A'=>"20", "H"=>"9R", "M2"=>'abcd');
            foreach($cifrado as $clave=> $valor){
                if(strpos($cadena, $clave)!=-1){
                    $cadena=str_replace($clave,$valor,$cadena);
                }
            }
            return $cadena;
        }

        echo nl2br("\n".cifrar("HOLA AMO"));


    ?>
</body>
</html>