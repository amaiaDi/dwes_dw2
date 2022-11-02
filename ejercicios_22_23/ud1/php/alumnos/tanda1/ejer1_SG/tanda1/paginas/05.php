<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <main>
        <?php
        /*5.	Función que:
            o	Define un array de arrays, representando cada posición/fila una correspondencia de nombre de persona con sus películas preferidas
            o	Recibe un nombre de película y devuelve cuántas personas la tienen entre sus favoritas
            o	Muestra, por cada persona, 2 de sus películas favoritas al azar*/
            function mostrarPeliculaPreferida($pelicula){
                $array = array(
                    "jon" => array("La vida de pi","Your Name","Origen","A silent voice"),
                    "ander" => array("Paprika","perfect blue","ghost in shell","A silent voice"),
                    "dio" => array("La teoria del todo","jurassic park","forest gump","Your Name","A silent voice"),
                    "sergio" => array("La tumba de las luciernagas","Cuentos de terramar","alita: battle angel")
                );
                $cont = 0;
                foreach ($array as $persona => $pelis) {
                    foreach($pelis as $peli){
                        if(strcasecmp($peli,$pelicula)==0){
                            $cont++;
                            break;
                        }
                    }
                    do{
                        $peli_ram1 = random_int(0,count($pelis)-1);
                        $peli_ram2 = random_int(0,count($pelis)-1);
                    }while(strcasecmp($peli_ram1,$peli_ram2)==0);
                    echo "<p> Algunas peliculas favoritas de " . $persona . " :" . $pelis[$peli_ram1] . " y " . $pelis[$peli_ram2] .  ".</p>"; 
                }
                echo "<p>La cantidad de persona que a visto " . $pelicula ." son " . $cont .".</p>";
            }
            mostrarPeliculaPreferida("A silent voice");
        ?>
    </main>
</body>
</html>