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

        $imagenes = array(
                        "imagenes/kounde.PNG", 
                        "imagenes/bellerin.PNG", 
                        "imagenes/araujo.PNG", 
                        "imagenes/gavi.PNG",
                        "imagenes/lewi.PNG",
                        "imagenes/terstegen.PNG");
        
        
            function tablero($imagen){
                $total = count($imagen);
                for ($i=0; $i < $total ; $i++) { 
                echo("<td><a href='$imagen[$i]'><img src='$imagen[$i]' widht='100' height='150'></a> </td>");
                    if (($i+1)%3==0) {
                        echo('<br>');
                    }
                }
            }
        tablero($imagenes);

    ?>
</body>
</html>