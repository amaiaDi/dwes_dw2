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
        $handle = fopen("txt/links.txt", "r");
        while (!feof($handle)) {
            $linea = fgets($handle);
            $link = substr($linea,0,strpos($linea,","));
            $nomURL = substr($linea,strpos($linea,",")+1);
            echo "<a href='$link'>$nomURL</a><br>";
        }
        fclose($handle);
    ?>
    <br></br>
    <a href="../index.php">Volver</a>
</body>
</html>