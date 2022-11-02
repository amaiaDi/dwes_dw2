<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 | Edgar Martínez Palmero</title>
</head>
<body>

    <?php 
        include 'funciones.php';
        include 'constantes.php';
        if (isset($_POST['ver'])) {
            echo "<form action='#' method='post'>";
            if (isset($_POST['cantImg'])) {
                $imagenes = random($_POST['cantImg'], DirIMG);
                construirTabla(DirIMG, $imagenes);
            }
        echo " <input type='submit' value='Enviar Valoraciones' name='enviar'>
        </form>";
        } else {
            if (isset($_POST['enviar'])) {
                if (isset($_POST['meGusta'])) {
                    echo "<p>Gracias por tu envio</p><br>";
                    escribirFichero(FICH, $_POST['meGusta']);
                } else {
                    echo "<p>Sentimos que no le haya gustado ninguna</p><br>";
                }
                echo "<a href='selec_cantidad.php'>Inicio</a>";
            }
        }
    ?>
</body>
</html>