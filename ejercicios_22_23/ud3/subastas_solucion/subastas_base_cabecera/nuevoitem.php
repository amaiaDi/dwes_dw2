<?php
    /**
     * Pagina de nuevo item que se carga en el div de contenido main
     */
    
    //Cagamos la estructura de la pagina de cabecera
    require("cabecera.php");
    //Establece la información de la ultima pagina visitada.Cargamos la de la pagina a la que accedemos porque será la anteior al movernos a la siguiente
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"];
?>

    <h1><?=TITULO_NUEVO_ITEM?></h1>
    <?php
    if(isset($_POST['btn_nuevo_item'])){
        // Obtengo la infomación de la categoria de la peticion en la variable POST mediante el envio del formulario
        $categoria = $_POST['categoria'];
        $id_categoria = getIdCategoria($categoria);
        
        // Recuperamos la fecha de la peticion en la variable POST mediante el envio del formulario
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $anio = $_POST['anio'];
        $hora = $_POST['hora'];
        $minutos = $_POST['minutos'];
        $str_fecha = "$anio-$mes-$dia $hora:$minutos";
        $fecha = strtotime($str_fecha);
        // Recuperamos nombre item de la peticion en la variable POST mediante el envio del formulario
        $nombre = $_POST['nombre'];
        // descripcion de la peticion en la variable POST mediante el envio del formulario
        $descripcion = $_POST['descripcion'];
        // precio de la peticion en la variable POST mediante el envio del formulario
        $precio = $_POST['precio'];
        
        //Validamos el formulario del nuevo item para mostrar mensajes en los elementos que falten
        $errores = validarNuevoItem($nombre, $descripcion, $precio, $fecha);
        if(empty($errores)){

            //obtenemos el id de usuario en base al nombre de usuario
            $id_usuario = getIdUsuario($usuario);
            
            // Comprobamos si existe un item con el mismo nombre en esa categoria
            if(!existeItemCategoriaNombre($nombre,$id_categoria )){
                insertarItem($id_categoria, $id_usuario, $nombre, $precio, $descripcion, $str_fecha);
                $id_item = getIdItem($nombre);
                header(("Location: editaritem.php?id_item=$id_item"));
            }else{
                $errores = "<p>* ".MSJ_ITEM_REPETIDO_NOMBRE_CATEGORIA."</p>";
            }
        }
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
    <div class="msg-rojo"><?php if(isset($errores)) echo $errores;?></div>

    <?php require("pie.php"); ?>
