<!-- En una primera página (selec_cantidad.php), el usuario seleccionará cuántas imágenes 
(residentes en una carpeta del servidor) desea visualizar.
Se le enviará a una 2ª página (eval_imag.php) en la que se visualizan ciertas 
imágenes al azar (en la cantidad que él ha elegido) y deberá valorarlas haciendo clic en 
los checkboxes adjuntos -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - seleccion de imagenes</title>
</head>
<?php
    include 'funciones.php';
    $numeroImagenes=0;
    $arrayImagenes=array();

    obtenerArrayImagenes('./imagenes');

   

?>

<body>
    <h1>Ejercicio 2: Evaluador de imágenes - Seleccione cantidad</h1>
    <form action="ejercicio2_eval_imag.php" method='post'>
        <table>
            <tr>
                <td>¿Cuantas imagenes deseas ver?</td>
                <td>
                    <select name="imagenes">
                        <?php 
                            for ($i=0;$i<count($arrayImagenes);$i++){
                                
                                if($arrayImagenes[$i]!='.' && $arrayImagenes[$i]!='..'){
                                    $numeroImagenes++;
                                    echo "<option value='$numeroImagenes'>$numeroImagenes</option>";
                                    
                                }
                            }
                        ?>       
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"> <input type="submit" value="Ver Imagenes" name="verImagenes"/> </td>
            </tr>
        </table>
    </form>
</body>
</html>