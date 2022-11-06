<?php
    /**
     * Pagina de nuevo item que se carga en el div de contenido main
     */
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"];
?>

<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Añade nuevo item</h1>
    <?php
    if(isset($_POST['btn_nuevo_item'])){
        // categoria
        $categoria = $_POST['categoria'];
        $id_categoria = idCategoria($categoria);
        // fecha
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $anio = $_POST['anio'];
        $hora = $_POST['hora'];
        $minutos = $_POST['minutos'];
        $str_fecha = "$anio-$mes-$dia $hora:$minutos";
        $fecha = strtotime($str_fecha);
        // nombre item
        $nombre = $_POST['nombre'];
        // descripcion
        $descripcion = $_POST['descripcion'];
        // precio
        $precio = $_POST['precio'];
        $errores = verificarNuevoItem($nombre, $descripcion, $precio, $fecha);
        if($errores == ""){
            // nombre usuario
            $usuario = $_SESSION['usuario'];
            $id_usuario = idUsuario($usuario);
            // NO COMPROBAMOS, NO LO PIDE, SI EL ITEM EXISTE
            insertarItem($id_categoria, $id_usuario, $nombre, $precio, $descripcion, $str_fecha);
            $id_item = idItem($nombre);
            header(("Location: editaritem.php?id_item=$id_item"));
        }
        // SI HAY ERRORES SE BORRA EL FORMULARIO, MIRAR ESTO

    }
    ?>
    <form action="nuevoitem.php" method="post">
        <table class="registro-login">
            <tr>
                <td><label for="categoria"></label>Categoría</td>
                <td><select name="categoria">
                    <?php
                        $categorias = obtenerCategorias();
                        foreach($categorias as $categoria){
                            echo "<option name='$categoria'>$categoria</option>";
                        }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td><label for="nombre">Nombre</label></td>
                <td><input type="text" name="nombre"></td>
            </tr>
            <tr>
                <td><label for="descripcion">Descripcion</label></td>
                <td><textarea name="descripcion" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><label for="fechafin">Fecha de fin para pujas</label></td>
                <td><table class="registro-login">
                    <tr class="registro-login">
                        <td>Día</td>
                        <td>Mes</td>
                        <td>Año</td>
                        <td>Hora</td>
                        <td>Minutos</td>
                    </tr>
                    <tr>
                        <?php 
                            crearFechaCompleta();
                        ?>
                    </tr>
                </table></td>
            </tr>
            <tr>
                <td><label for="precio">Precio</label></td>
                <td><input type="text" name="precio"><b>&nbsp;€</b></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Enviar!" class="btn-enviar" name="btn_nuevo_item"></td>
            </tr>
        </table>
    </form>
    <div><?php if(isset($errores)) echo $errores;?></div>

    <?php require("pie.php"); ?>

</body>
</html>