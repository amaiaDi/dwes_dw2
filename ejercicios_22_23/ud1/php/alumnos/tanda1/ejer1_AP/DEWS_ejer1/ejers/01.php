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
    echo date("j") . "th " . date("F") . " " . date("Y") . ", " . date("l");
?> 
<br></br>
<?php
    $date_str="2023/01/01";
    $date2=strtotime($date_str);
    $date1=time();
    echo (int)(($date2-$date1)/(60*60*24));
?>
<br></br>
<?php
    $array = array("Ander", "Panera", "19");
    $str_suma="";
    foreach ($array as &$str) {
        $str_suma = $str_suma . $str;
    }
    echo $str_suma;
?>
<br></br>
<?php
    $str_con_ene = "Mañana Peñas";
    echo str_replace("ñ","gn",$str_con_ene);
?>
<br></br>
<table style="border: 1px solid">
    <tr>
<?php
    function arr_random($n, $limite1, $limite2) {
        $con=1;
        while ($con<=$n) {
            $arr[$con-1]=random_int($limite1, $limite2);
            $con++;
        }
        return $arr;
    }
    $arr_real = arr_random(4,0,10);
    foreach ($arr_real as &$num) {
        echo "<td style='border: 1px solid'>" . $num . "</td>";
    }
?>
    </tr>
</table>
<br></br>
<?php
    function cifrado($string) {
        $cifrado=["A"=>"20", "H"=>"9R", "M"=>"abcd"];
        $cifrado_keys=array_keys($cifrado);
        $cifrado_values=array_values($cifrado);
        foreach($cifrado_keys as &$letra) {
            $string = str_replace($letra,$cifrado[$letra],$string);
        }
        return $string;
    }
    echo cifrado("HOLA AMO");
?>
<br></br>
<a href="../index.php">Volver</a>
</body>
</html>