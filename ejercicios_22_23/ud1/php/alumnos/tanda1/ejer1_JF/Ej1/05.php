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

// Define un array de arrays, representando cada posición/fila una correspondencia de nombre de persona con sus películas preferidas
// Recibe un nombre de película y devuelve cuántas personas la tienen entre sus favoritas
// Muestra, por cada persona, 2 de sus películas favoritas al azar



    function numPer($peli){
        $personas=['Juan' => array('Peli1','Peli3','Peli4'),'Omar'=> array('Peli2','Peli3'),'Iker'=> array('Peli1','Peli2','Peli2','Peli4'),'Unai'=> array('Peli5')];
        $cont=0;
        foreach($personas as $value){
          if(in_array($peli,$value))
            $cont++;
                
        }
        return $cont;
    }

     echo (numPer('Peli1'));




    ?>
</body>
</html>