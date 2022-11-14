<?php
    /**
     * Pagina de publicidad que se carga en el div de contenido main
     */
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"]; 
    $anunciante="";
    $recibido="";
    $radioSelect="";
    $id_item="";
    $items_vencer = getSubastasAPuntoVencer();
    $seleccion_items = [];


    foreach($items_vencer as $id => $nombre){
        $precio_max = getPrecioMaximo($id);
        $precio = getPrecioItem($id);
        if(getCantidadPujas($id) == 0){
            $seleccion_items[$id] = $nombre;
        }
        elseif (($precio * 1.10) >= $precio_max){
            $seleccion_items[$id] = $nombre;
        }
    }

    if(isset($_SESSION['anuncios'])){
        if(isset($_GET['item_id'])){
            $id_item = $_GET['item_id'];
        } 
    
        if(isset($_POST['aniadir_anunciante'])){
            
            if(isset($_POST['radio_btn'.$id_item])){
                $recibido = $_POST['radio_btn'.$id_item];
                $radioSelect='radio_btn'.$id_item;
            }   
            
            if(isset($_POST['anunciante']) && !empty($_POST['anunciante'])){
                $anunciante = $_POST['anunciante'];
                if($recibido === "web"){
                    $descripcion = obtenerDescripcion($id_item);
                    $guardar = $anunciante . " - " . $descripcion;
                    array_push($_SESSION['anuncios']['web'], $guardar);
                }
                elseif($recibido === "email"){
                    $nombre_item = getNombreItem($id_item);
                    $guardar = $_POST['anunciante'] . ";" . $id_item . ";" . $nombre_item;
                    array_push($_SESSION['anuncios']['email'], $guardar);
                }
    
            }
        }
        if(isset($_POST['enviar_anuncios'])){
            $web = $_SESSION['anuncios']['web'];
            if(!empty($web)){
                $file = fopen("archivos/anunciantes.txt", "w");
                foreach($_SESSION['anuncios']['web'] as $w){
                    fwrite($file, $w . PHP_EOL);
                }       
                fclose($file);
                $_SESSION['anuncios']['web'] = [];
            }
            $direcciones = $_SESSION['anuncios']['email'];
            if(!empty($direcciones)){
                foreach($direcciones as $dir){
                    $partes = explode(";", $dir);
                    $email = $partes[0];
                    $id = $partes[1];
                    $nombre = getNombreItem($id);       
                    $enlace=obtenerRutaFicheroHTTP()."/itemdetalles.php?item_id=$id&item_nombre=$nombre";  

                    $mens=<<<MAIL
                    Hola,
                    desde Subastas DWES te envíamos el enlace a un artículo que podría interesarte.
                    $enlace
                    Gracias
                    MAIL;
                    
                    if (mail($email,"Artículo interesante", $mens, "From:dwes.icj@gmail.com")){
                        $_SESSION['anuncios']['email'] = [];
                    }
                    else{
                        echo "No se pudo enviar mensaje";
                    }
                }
            }
            $_SESSION['anuncios']['email'] = [];
        }
    }
    else {
        $_SESSION['anuncios'] = ["web" => [], "email" => []];
    }
?> 

<h1><?=TITULO_SUBASTAS_VENCER?></h1>
<table>
    <tr>
        <th><?=TITULO_ITEM?></th>
        <th><?=TITULO_VENCE_EN?></th>
        <th><?=TITULO_ANUNCIANTE?></th>
        <th><?=TITULO_TIPO?></th>
        <th></th>
    </tr>
    <?php 
    foreach($seleccion_items as $id_item_anun => $nombre){
        $vence = getFechaVencimiento($id_item_anun);
        $nom = $nombre;
    ?>
        <tr>
            <form action='<?php echo 'publi.php?item_id='.$id_item_anun?>' method='post'>
                <td><?php echo $nombre;?></td>
                <td><?php echo $vence;?></td>
                <td><input type='text' name='anunciante' value='<?= $id_item==$id_item_anun?$anunciante:''?>'></td>
                <td>
                    <input type='radio' name='<?='radio_btn'.$id_item_anun?>' value='email' <?=($recibido=='email' && 'radio_btn'.$id_item_anun==$radioSelect)?'checked':''?>>
                    <label for='email'>Email</label>
                    <input type='radio' name='<?='radio_btn'.$id_item_anun?>' value='web' <?=($recibido=='web' && 'radio_btn'.$id_item_anun==$radioSelect)?'checked':''?>>
                    <label for='email'>Web</label>
                </td>
                <td><input type='submit' name='aniadir_anunciante' value='Añadir'></td>
            </form>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td colspan="5">
            <form action='<?php echo 'publi.php'?>' method='post'>
                <input type="submit" value="ENVIAR ANUNCIOS" name="enviar_anuncios" class="btn-enviar">
            </form>
        </td>
    </tr>
</table>
<?php require("pie.php"); ?>