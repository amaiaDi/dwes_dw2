<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>03</title>
</head>
<body>
    <?php
    $ciudades = array("Vitoria", "New York", "Los angeles", "Tokyo", "Kioto", "Madrid", "Tokyo", "Andorra", "Kioto", "Alemania");

    echo"<ol>";
            $igual=false;
            for($i=0;$i<count($ciudades);$i++)
            {
                for($i1=0;$i1<$i;$i1++)
                {
                    if($ciudades[$i1]==$ciudades[$i])
                    {
                        $igual=true;
                        break;
                    }
                }
                if($igual==false)
                {
                    echo "<li>$ciudades[$i]</li>";
                }
                else
                {
                    $igual=false;
                }
            }
    echo "</ol>";
    ?>
</body>
</html>