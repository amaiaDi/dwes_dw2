<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <main>
        <h1>Ciudades: </h1>
        <ul>
            <?php 
                /*3.Crea un array con 10 nombres de ciudades, que puede contener repetidos.
                Visualízalo, en forma de lista numerada y sin repetidos.*/
                $ciudades = array("Vitoria-Gasteiz","Bilbao","Barcelona","Cadiz","Bilbao","Madrid","Burgos","Cadiz", "sevilla", "San Sebastian","Madrid");
                $ciudades_distintas = array_unique($ciudades);
                foreach ($ciudades_distintas as $ciudad) {
                    echo "<li>".$ciudad . "</li>";
                }
            ?>
        </ul>
    </main>
</body>
</html>