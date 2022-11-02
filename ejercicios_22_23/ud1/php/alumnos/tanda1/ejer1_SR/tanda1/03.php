<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>03</title>
</head>
<body>
    <?php
        $ciudades = ['Vitoria', 'Paris', 'Roma', 'Londres', 'Vitoria', 'Madrid', 'Valencia', 'Madrid', 'Londres', 'New York'];
        $ciudades = array_unique($ciudades);
        $ciudades = array_slice($ciudades, 0);
        echo "
            <ol>";
             for($c = 0; $c < count($ciudades); $c++)
             {
                echo "<li>$ciudades[$c]</li>";   
             }
            echo "
            </ol>
        ";
    ?>
</body>
</html>