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
        
        $imagenes = array("images/mar1.jpg","images/mar2.jpg","images/mar3.jpg","images/mar4.jpg","images/mar5.jpg","images/mar6.jpg",);
        
        function tablaImagenes ($imgs){
            echo "<table>";
            
            $imgs  = array_unique($imgs);
            $cont = 1;
            echo "<tr>";
            foreach ($imgs as $img){
                echo "<td><a href='".$img."'><img src='".$img."' width=300 height=300></a></td>";
                
                if ($cont == 3){
                    echo "</tr><tr>";
                }  
                $cont++;  
            }


            echo "</table>";

        }

        tablaImagenes($imagenes);

        
    ?>
</body>
</html>