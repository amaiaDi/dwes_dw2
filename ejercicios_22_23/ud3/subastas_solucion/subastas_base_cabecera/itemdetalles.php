<?php
    /**
     * Pagina de detalle de item que se carga en el div de contenido main
     */
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"]; 

    if(isset($_GET['item_id'])){
        $id = $_GET['item_id'];
        $num_pujas = getCantidadPujas($id);
        $precio = getPrecioMaximo($id);
        $fecha = getFechaFinPuja($id);
    }
    if(isset($_GET['item_nombre'])){
        $nombre = $_GET['item_nombre'];
    }
    
    if(isset($_POST['puja'])){
        $usuario = $_SESSION['usuario'];
        $cant_puja = $_POST['cant_puja'];
        if($cant_puja <= $precio){
            $mensaje = "<td class='msg-rojo'>Puja muy baja!</td>";
        }
        elseif(getPujasUsuario($id, $usuario) > 2){
            $mensaje = "<td class='msg-rojo'>Límite de 3 pujas por día</td>";
        }
        elseif(array_key_exists($id, getSubastasVencidas()) ){
            $mensaje = "<td class='msg-rojo'>La subasta ya ha finalizado</td>";
        }
        else {
            $usuario = $_SESSION['usuario'];
            insertarPuja($id, $usuario, $cant_puja);
        }
    }
?>
<h1><?php if(isset($nombre)) echo $nombre;?></h1>
<?php 
    echo "<p><b>Número de pujas:</b> $num_pujas - 
                <b>Precio actual:</b> $precio €-
                <b>Fecha fin para pujar:</b> $fecha
            </p>";

    //Obtenemos las imagenes del item y las mostramos por pantalal
    $arr_img = obtenerImagenes($id);
    foreach($arr_img as $img){
        echo "<img src='$img' class='imagen'>";
    }
    //Obtenemos su descripcion y la mostramos por pantalla
    $descripcion = obtenerDescripcion($id);
    echo "<p>$descripcion</p>";
    
    //Si el usuario esta logueado se muestra la información de las pujas
    if(isset($_SESSION['usuario'])){
        //Comprobamos si la fecha de la puja ha finalizado. 
        //Si la subasta ha finalizado no mostramos la opción de pujar
        if(sigueSubastaEnActivo($fecha)){
?>      
            <h2>Pujar por este item</h2>
            <form action=<?php echo "itemdetalles.php?item_id=$id&item_nombre=$nombre";?> method="post">
                <table>
                    <tr>
                        <td><input type="text" name="cant_puja"></td>
                        <td><input type="submit" value="¡Puja!" name="puja"></td>
                        <?php if(isset($mensaje)) echo $mensaje ;?>
                    </tr>
                </table>
            </form>
<?php    }
        // Muestra la información del hisotrial de pujas
?>
        <h2>Historial de la puja</h2>   
<?php
        $historial = obtenerHistorial($id);
        if(count($historial) == 0){
            echo "No hay pujas todavía para este artículo";
        }
        else {
            echo "<ul>";
            foreach($historial as $puja){
                echo "<li>$puja</li>";
            }
            echo "</ul>";
        }
    }
else {
        echo "<p>Para pujar, debes autenticarte <a href='login.php'>aquí</a></p>";
}
?>

<?php require("pie.php"); ?>
