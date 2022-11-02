<?php
require_once 'lib/date_formats.php';
define("CURRENT_DATE", date(DATE_RFC2822));

getCurrentDate();
getDaysToEndOfYear();
wordArray();
replace_nYah("La cabaña de la cigüeña está cerca de la montaña. Por pequeña que sea, construirla fue una gran hazaña.");
echo "<p>".join(", ", randomArray(10, 69, 420))."</p>";
echo "<p>".encodeString("HOLA AMO")."</p>";

function getCurrentDate()
{
    $dateFormat=DATE_FORMATS["DAY"].'\t\h '.DATE_FORMATS["MONTH_TEXT"].' '.DATE_FORMATS["YEAR"].', '.DATE_FORMATS["DAY_TEXT"];
    echo "<p>Fecha: ".getFormatedDate(CURRENT_DATE, $dateFormat)."</p>";
}
function getDaysToEndOfYear()
{
    $secondsToEndOfYear=mktime(0,0,0,1,1,2023)-time();
    $daysToEndOfYear=floor($secondsToEndOfYear/(60*60*24));
    echo "<p>Quedan ".$daysToEndOfYear." días para terminar el año.</p>";
}
function wordArray()
{
    $resultado="";
    $wordArray=
    [
        "Contra","todo","el","mal","que","el","infierno","puede","conjurar,",
        "contra","toda","la","perversión","de","la","humanidad,","vamos","a",
        "enviarles","solo","a","ti.","Destroza","y","desgarra","hasta","que",
        "termines."
    ];

    foreach($wordArray as $word)
        $resultado.=$word." ";
    
    echo "<p>$resultado</p>";
}
function replace_nYah($input)
{
    $output=str_replace('ñ', 'gn', $input);
    echo "<p>$output</p>";
}
function randomArray($n, $lowLimit, $highLimit)
{
    $output=[];
    if($lowLimit>$highLimit)
    {
        $temp=$highLimit;
        $highLimit=$lowLimit;
        $lowLimit=$temp;
    }

    for($contN=0; $contN<$n; $contN++) 
    {
        $randNumber=rand($lowLimit, $highLimit);
        $output[$contN]=$randNumber;
    }
    return $output;
}
function encodeString($input)
{
    $map = 
    [
        "A" => "20",
        "H" => "9R",
        "M" => "abcd"
    ];
    $output="";
    
    for($i=0; $i<strlen($input); $i++)
    {
        $letter=$input[$i];
        $letterUpper=strtoupper($letter);
        if(isset($map[$letterUpper]))
            $output.=$map[$letter];
        else 
            $output.=$letter;
    }
    return $output;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    
</body>
</html>