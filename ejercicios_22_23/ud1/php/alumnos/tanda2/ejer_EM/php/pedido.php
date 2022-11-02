<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 | Edgar Martínez Palmero</title>
    <link rel="stylesheet" href="../style/ejercicio3.css">
</head>
<body>
    <div class="container">
        <div>
            <?php 
                include 'funciones.php';
                include 'constantes.php';
                crearTablaPedidos(ART, RUTA);
            ?>
        </div>
        <div>
            <form action="#" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th colspan="2" class="titulo">AÑADE ARTICULO</th>
                    </tr>
                    <tr>
                        <td><label for="nombre">Nombre:</label></td>
                        <td><label for="precio">Precio:</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nombre" id="nombre"></td>
                        <td><input type="text" name="precio" id="precio"></td>
                    </tr>
                    <tr colspan="2">
                        <td>
                            <label for="fich">Fichero:</label>
                            <input type="file" name="fich" id="fich" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="btn">
                            <input type="submit" value="Enviar" name="articuloNuevo">
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
            
                if (isset($_POST['articuloNuevo'])) {
                    articuloNuevo(ART, RUTA);
                }
            ?>
        </div>
    </div>
    

</body>
</html>