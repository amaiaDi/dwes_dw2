<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>04</title>
</head>
<body>
    <?php
    $arrImg = array("paisaje1","paisaje2","paisaje3","paisaje4","paisaje5","paisaje2");
    function mostrarImagenes($arrImg)
    {
        $arrImg = array_unique($arrImg);
        $arrImg = array_slice($arrImg, 0);
        echo "
        <table>
            <tr>
        ";
        $cont=0;
        for($i=0;$i<count($arrImg);$i++)
        {
            if($cont==3)
            {
                echo "</tr><tr>";
                $cont=0;
            }
            echo "<td><a href='imagenes/{$arrImg[$i]}.jpg'><img src='imagenes/{$arrImg[$i]}.jpg' alt='{$arrImg[$i]}' width='400' height='200'/></a></td>";
            $cont++;
        }
        
        echo"</table>";
    }
    mostrarImagenes($arrImg);
    ?>
</body>
</html>