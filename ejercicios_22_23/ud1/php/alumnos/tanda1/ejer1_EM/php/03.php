<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 | Edgar Martínez Palmero</title>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <?php
        $ciudades = array(
            'Barcelona',
            'Girona',
            'Salou',
            'Vitoria',
            'Bilbao',
            'barcelona',
            'GIRONA',
            'Londres',
            'Vice City',
            'Los Santos'
        );
        // Ciudades: Barcelona, Girona, Salou, Vitoria, Bilbao, barcelona, GIRONA, Londres, Vice City, Los Santos
        /* 
            Resultado Esperado: 
            1. Barcelona
            2. Girona
            3. Salou
            4. Vitoria
            5. Bilbao
            6. Londres
            7. Vice City
            8. Los Santos 
        */
        /*
            Se crea un array donde se guardaran las ciudades en minúsculas con la primera letra en mayúsculas para
            poder evitar duplicados
        */
        array_unique($ciudades);
        $ciudadesCap = array();
        foreach($ciudades as $valor) {
            $ciudadesCap[] = ucfirst(strtolower($valor));
        }
        // Visualizar array sin repetidos
        echo '<ol>';
        foreach(array_unique($ciudadesCap) as $valor) {
            echo '<li>'.$valor.'</li>';
        }
        echo '</ol>';
    ?>
</body>
</html>