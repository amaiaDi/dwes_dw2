<?php
    /**
     * Pagina de publicidad que se carga en el div de contenido main
     */
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"]; 
    $items_vencer = subastasAPuntoVencer();
    $seleccion_items = [];
    foreach($items_vencer as $id => $nombre){
        $precio_max = precioMaximo($id);
        $precio = precioItem($id);
        if(cantidadPujas($id) == 0){
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
    
        if(isset($_POST['radio_btn'])){
            $recibido = $_POST['radio_btn'];
            if(isset($_POST['anunciante']) && !empty($_POST['anunciante'])){
                $anunciante = $_POST['anunciante'];
                if($recibido === "web"){
                    $descripcion = obtenerDescripcion($id_item);
                    $guardar = $anunciante . " - " . $descripcion;
                    array_push($_SESSION['anuncios']['web'], $guardar);
                }
                elseif($recibido === "email"){
                    $nombre_item = nombreItem($id_item);
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
                    $nombre = nombreItem($id);       
                    $enlace="http://localhost/dwes/ud3%20-%20BBDD/subastas/itemdetalles.php?item_id=$id&item_nombre=$nombre";  

                    $mens=<<<MAIL
                    Hola,
                    desde Subastas Paco te envíamos el enlace a un artículo que podría interesarte.
                    $enlace
                    Gracias
                    MAIL;
                    
                    if (mail($email,"Artículo interesante", $mens, "From:subastas.practica@gmail.com")){
                        echo "Mensaje enviado:<br><br>";
                        echo "Pongo el enlace para comprobar que lleva al artículo:<br><br>";
                        echo "$enlace<br><br>";
                    }
                    else{
                        echo "No se pudo enviar mensaje";
                    }
                }
                $_SESSION['anuncios']['email'] = [];
            }
        }
    }
    else {
        $_SESSION['anuncios'] = ["web" => [], "email" => []];
    }
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Subastas a punto de vencer</h1>
        <table>
            <tr>
                <th>ITEM</th>
                <th>VENCE EN</th>
                <th>ANUNCIANTE</th>
                <th>TIPO</th>
                <th></th>
            </tr>
            
            <?php
                    
                    foreach($seleccion_items as $id => $nombre){
                        $vence = venceEn($id);
                        $nom = $nombre;
                        ?>
                        <form action=<?php echo "publi.php?item_id=$id";?> method='post'>
                        <tr>
                            <td><?php echo $nombre;?></td>
                            <td><?php echo $vence;?></td>
                            <td><input type='text' name='anunciante'></td>
                            <td>
                                <input type='radio' name='radio_btn' value='email'>
                                <label for='email'>Email</label>
                                <input type='radio' name='radio_btn' value='web'>
                                <label for='email'>Web</label>
                            </td>
                            <td><input type='submit' name='aniadir_anunciante' value='Añadir'></td>
                        </form>
                    </tr>
                    <?php
                    }
                    ?>
              <form action="publi.php" method="post">
                <tr><td colspan="5"><input type="submit" value="ENVIAR ANUNCIOS" name="enviar_anuncios" class="btn-enviar"></tr></td>
            </form>
        </table>
    <?php require("pie.php"); ?>

</body>
</html>