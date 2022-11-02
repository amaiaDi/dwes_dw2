<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php

    include '../funciones.php';
    $numeroImagenesSeleccionadas=0;
    $arrayImagenes=array();
    $estructuraTabla="";
    $mensajeImagenesVacias="";

    obtenerArrayImagenes('../imagenes');

    if (isset($_POST['verImagenes']) ) 
    {
        if(empty($_POST['imagenes'])){
            $numeroImagenesSeleccionadas=$_POST['imagenes'];
        }

    }


?>
<body>
    <h1>Ejercicio 2: Evaluador de imágenes</h1>
    <?php 
        if(isset($_POST['verImagenes']) && !empty($_POST['imagenes'])){

    ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post">
            <table>
                <?php 

                for($i=0;$i<$numeroImagenesSeleccionadas;$i++){
                    echo "<tr><td>";

                    echo "</td><td>";

                    echo "</td></tr>";
                    
                }                
                ?>  
            </table>
        </form>
    <?php 
        
        }
    ?>
</body>
</html>