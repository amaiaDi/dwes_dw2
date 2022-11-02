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
        $array1 = ["MADRID","BARCELONA","VITORIA","VITORIA","LUGO","VIGO","BURGOS","MIRANDA","MALAGA","MANDRIL"];
        $array1=array_values(array_unique($array1));
        for ($i=0; $i < count($array1) ; $i++) { 
            echo($array1[$i]);echo("<br>");
        }
        
    ?>
</body>
</html>