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
        $fecha = "31-12-2022";
        $fechahoy =  date("Y-m-d");
        $resta = strtotime($fechahoy)-strtotime($fecha);
        $dias = $resta / (24*3600);
        echo "diferencia en dias: ".$dias;
    ?>
</body>
</html>