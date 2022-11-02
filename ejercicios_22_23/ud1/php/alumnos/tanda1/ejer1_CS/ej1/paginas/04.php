<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej 4</title>
</head>
<body>
    <?php
        $arrImg = array( "../imagenes/descarga.png", "../imagenes/descarga2.png", "../imagenes/descarga3.png", "../imagenes/descarga4.png", "../imagenes/descarga.png", "../imagenes/descarga3.png");
        echo "<table>";
        $arrImgNoDup = array_unique($arrImg);
        $cont = count($arrImgNoDup);
        $columnas = 0;
        echo "<tr>";
        for ($i=0; $i < $cont; $i++) { 
              
            if ($columnas == 3) {
                echo "</tr>";
                echo "<tr>";
                $columnas = 0;
            }
            echo "<td>";
            echo "<a href='".$arrImgNoDup[$i]."'/><img src='".$arrImgNoDup[$i]."' alt='Una foto' width=500 height=341></a>";
            echo "</td>";
            $columnas++;
        }
        echo "</table>";

    ?>
</body>
</html>