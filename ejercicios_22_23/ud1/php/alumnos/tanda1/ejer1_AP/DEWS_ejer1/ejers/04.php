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
        function tablaImg($arr) {
            $arr = array_unique($arr);
            echo "<table border='2px' style='border-collapse: collapse'>";
            $saltoRow = 0;
            $cols = 3;
            foreach($arr as &$img) {
                if ($saltoRow==0) {
                    echo "<tr>";
                }
                echo "<td><a href='$img'><img src='$img' width='100' height='100'></img></a></td>";
                $saltoRow++;
                if ($saltoRow==$cols) {
                    echo "</tr>";
                }
            }
            echo "</table>";
        }

        tablaImg(array("img/haven.jpg","img/cypher.jpg","img/jett.jpg","img/chamber.jpg","img/killjoy.jpg","img/jett.jpg","img/chamber.jpg","img/killjoy.jpg"));
    ?>
<br></br>
<a href="../index.php">Volver</a>
</body>
</html>