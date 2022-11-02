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

    // Crea un array con 10 nombres de ciudades, que puede contener repetidos.
    // Visualízalo, en forma de lista numerada y sin repetidos.

        $city=['Barcelona','Vitoria','Vitoria','Bilbo','Donostia','Iruña','Vitoria'];
        print_r(array_unique($city));


    ?>

</body>
</html>