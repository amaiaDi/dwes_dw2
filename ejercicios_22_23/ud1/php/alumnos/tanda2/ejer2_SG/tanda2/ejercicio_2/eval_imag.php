<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <main>
        <?php
            //funcion que me devuelve el array de imagenes con la ruta completa
            function rutas_imag(){
                session_start();
                $arr = $_SESSION['array'];
                session_abort();
                return $arr;
            }
            //validacion de que si existe valoraciones
            if(!isset($_POST["valoraciones"])){
                $imgs = rutas_imag();
                $cant = $_POST["cantidad_img"];
                $imgs_index = array_rand($imgs,$cant);
                echo "<form action='eval_imag.php' method='post'><table>";
                for ($i=0; $i <$cant; $i++) { 
                    echo "<tr><td><img src='". $imgs[$imgs_index[$i]] ."' alt='" . $imgs[$imgs_index[$i]] . "' width='250' height='150'></td>";
                    $id = substr($imgs[$imgs_index[$i]],strpos($imgs[$imgs_index[$i]],"/")+1);
                    echo "<td><input type='checkbox' name='me_gusta[]' id='". $id ."' value='".$id."'>";
                    echo "<label for='".$id."'>Me Gusta</label></td></tr>";
                }
                echo "<tr><td><input type='submit' name='valoraciones' value='ENVIAR VALORACIONES'></td></tr>";
                echo "</table></form>";
            }else{
                if(!empty($_POST["me_gusta"])){
                    echo "<p>Gracias por tu envio</p>";
                    $archivo = fopen("../ficheros_ejercicio2_5/persona_img-gustas.txt","a");
                    $string = $_SERVER['REMOTE_ADDR'] .": " ;
                    $checks = $_POST["me_gusta"];
                    for ($i=0; $i < count($checks); $i++) { 
                        $string = $string . $checks[$i] . " ";
                    }
                    fwrite($archivo,$string."\n");
                }else{
                    echo "<p>Sentimos que no le haya gustado ninguna</p>";
                }
                echo "<a href='select_cantidad.php'>volver</a>";
            }
        ?>
    </main>
</body>
</html>