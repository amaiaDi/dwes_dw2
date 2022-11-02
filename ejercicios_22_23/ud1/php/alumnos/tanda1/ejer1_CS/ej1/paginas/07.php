<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej7</title>
</head>
<body>
    <?php
        $myfile = fopen("links.txt", "r");
        while (!feof($myfile)) {
            $linea = fgets($myfile);    
            $pos1Punto = strpos($linea,".");
            $nuevaLinea = substr($linea,$pos1Punto + 1);
            echo "<a href=".$linea.">".substr($nuevaLinea,0,strpos($nuevaLinea,"."))."<br>";    
        }
    fclose($myfile);
    ?>
</body>
</html>
