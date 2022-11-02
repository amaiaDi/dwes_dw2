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
        $arrCiudades = array("benalmadena","mandril","fuengirola","san isidro",
                            "estepona","vitoria","ferrol","benalmadena","murcia",
                            "san isidro");
        foreach ($arrCiudades as $key) {
            echo($key."<br>");
        }
        echo("<br>");
        $arrCiudades = array_values(array_unique($arrCiudades));
        for ($i=0; $i < count($arrCiudades); $i++) { 
            echo(($i+1)."-".$arrCiudades[$i]."<br>");
        }
     ?>
</body>
</html>