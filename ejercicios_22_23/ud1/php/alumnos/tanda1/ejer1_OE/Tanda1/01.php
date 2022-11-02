<!DOCTYPE html>
<html>
<body>

<?php
    //Muestra la fecha actual con el formato:    17th  September 2021, Wednesday
    echo date('jS  F Y, l');
    echo ('<br>');

    //Muestra cuántos días quedan para finalizar el año
    $resta = strtotime(date("Y-m-d"))-strtotime("2022-12-31");
    $dias = $resta / (24*3600)*-1;
    echo "Quedan ".$dias ." días para que acabe el año.";
    echo ('<br>');
    
    //Crea una cadena/frase a partir de los elementos de un array de palabras y la visualiza.
    $palabras = array("Hola", "que", "tal");
    $frase = implode(" ",$palabras);
    echo $frase; 
    echo ('<br>');

    //A partir de una cadena con eñes, crea y visualiza otra que reemplace las eñes por “gn”
    $cadena1 = "Montaña, mañana, lasaña";
    $cadena2 = str_replace("ñ","gn", $cadena1);
    echo $cadena2 ."<br>";

    //Función que devuelve un array con n números aleatorios entre limite1 y limite2
    function array_num_alt($min, $max, $n) {
        for ( $cont= 0; $cont < $n; $cont++) {
            $numeros[$cont] = rand($min, $max);
        }
		return $numeros;
	}
    echo implode(" ",array_num_alt(0,10,4));

    //Función que recibe una cadena y la devuelve cifrada.
    //Para saber cómo cifrar cada letra, utiliza un array constante asociativo que tiene como claves los caracteres y como valores sus cifrados.
    //Por ejemplo, dado el array de cifrado [“A”=>”20”, “H”=>”9R”, “M”=>”abcd”], la cadena “HOLA AMO”, se cifraría como “9ROL20 20abcdo”
    function cifrar_cadena($cadena) {
        $biblioteca = array("A"=>"20", "H"=>"9R", "M"=>"abcd");
        foreach ($biblioteca as $clave => $valor){
            if(strpos($cadena, $clave)!=-1){
                $cadena = str_replace($clave, $valor, $cadena);
            }
        }
		return $cadena;
	}
    echo nl2br("\n".cifrar_cadena("HOLA AMO"));
?> 

</body>
</html>