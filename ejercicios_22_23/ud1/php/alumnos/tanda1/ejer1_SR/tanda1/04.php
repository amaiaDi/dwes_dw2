<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>04</title>
</head>
<body>
    <?php
        $imgs = ['img1', 'img2', 'img3', 'img4', 'img5', 'img2'];
        function imagenes($imgs)
        {
            $imgs = array_unique($imgs);
            $imgs = array_slice($imgs, 0);
            echo "
            <table>
                ";
                $cont = 0;
                echo "<tr>";
                for($c = 0; $c < count($imgs); $c++)
                {
                    echo "<td><a href='images/$imgs[$c]'><img src='images/$imgs[$c]' alt='$imgs[$c]' width='650' height='500'></a>";
                    if($cont == 2)
                    {
                        $cont = -1;
                        echo "</tr>";
                        echo "<tr>";
                    }
                    echo "</td>";
                    $cont++;
                }
                echo"
            </table>";
        }
        imagenes($imgs);
    ?>
</body>
</html>