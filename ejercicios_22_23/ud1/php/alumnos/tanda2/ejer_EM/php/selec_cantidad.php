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
    ?>
    
    <form action="eval_img.php" method="post">
        <label for="cantImg">¿Cuántas imágenes deseas ver?</label>
        <select id="cantImg" name="cantImg">
            <?php
                
                cuantasOpeciones(DirIMG);
            ?>
        </select>
        <br>
        <input type="submit" value="Ver Imágenes" name='ver'>
    </form>
</body>
</html>