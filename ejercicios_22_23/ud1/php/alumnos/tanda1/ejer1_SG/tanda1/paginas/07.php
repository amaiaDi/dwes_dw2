<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <main>
        <?php
            echo "<nav>";
            $handle = fopen("../ficheros/urls.txt", "r");
            while (!feof($handle)) {
                $linea = fgets($handle);
                echo "<a href ='". substr($linea,0,strpos($linea,"+")-1) ."'>".
                substr($linea,strpos($linea,"+")+1)."</a><br/>";
            }
            fclose($handle);
            echo "</nav>";
        ?>
    </main>
</body>
</html>