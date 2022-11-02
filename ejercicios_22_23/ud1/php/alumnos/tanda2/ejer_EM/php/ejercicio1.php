<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 | Edgar Martínez Palmero</title>
</head>
<body>
    <?php 
        include 'funciones.php';
        include 'constantes.php'; 
    ?>
    <form action="#" method="post">
        <label for="txt">Texto a cifrar</label>
        <input type="text" name="txt" id="txt">
        <br>
        <label for="desplazamiento">Desplazamiento</label>
        <?php 
            foreach (ArrDesplazamiento as $value) {
                echo "<input type='radio' id='desp$value' name='desplazamiento' value='$value'>";
                echo "<label for='desp$value'>$value</label>";
            }
        ?>
        <input type="submit" value="CIFRADO CESAR" name="cesar">
        <br>
        <label for="clave">Fichero de la clave</label>
        <select name="clave" id="clave">
            <?php 
                $ficheros = array_slice(scandir(DIR), 2, count(scandir(DIR)));
                foreach($ficheros as $fichero) {
                    echo "<option>$fichero</option>";
                }
            ?>
        </select>
        <input type="submit" value="CIFRADO POR SUSTITUCION" name="sustitucion">
    </form>
    <?php
        
        $errores = array();
        // Se ha pulsado "CIFRADO CESAR"
        if(isset($_POST['cesar'])) {
            cesarPulsado(); 
        }
        // Se ha pulsado "CIFRADO POR SUSTITUCION"
        if (isset($_POST['sustitucion'])) {
            sustitucionPulsado();
        }   
    ?>
</body>
</html>