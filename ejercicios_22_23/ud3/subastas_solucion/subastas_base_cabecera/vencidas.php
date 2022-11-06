<?php
    /**
     * Pagina de subastas vencidas que se carga en el div de contenido main
     */
    require("cabecera.php");
    $_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"]; 
    if(isset($_POST['borrar'])){
        if(!empty($_POST['borrar_vencida'])){
            $arr_borrar = $_POST['borrar_vencida'];
            foreach($arr_borrar as $id_borrar){
                eliminarItem($id_borrar);
            }
            header("Location: vencidas.php");
        }
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
    <h1>Subastas Vencidas</h1>
    <?php
    if(isset($arr_borrar)){
        foreach($arr_borrar as $b){
            echo "$b<br>";
        }
    }
    ?>
    <form action="vencidas.php" method="post">
        <table>
            <tr>
                <th></th>
                <th>ITEM</th>
                <th>PRECIO FINAL</th>
                <th>GANADOR</th>
            </tr>
            
            <?php
                $subastas = subastasVencidas();
                foreach($subastas as $id_item => $nom_item){
                    $precio_final = precioMaximo($id_item);
                    $id_ganador = pujaMaxima($id_item);
                    if($id_ganador == null){
                        $ganador = "Sin pujas";
                    }
                    else{
                        $ganador = nombreUsuario($id_ganador);
                    }
                    echo " <tr>
                    <td><input type='checkbox' name='borrar_vencida[]' value='$id_item'></td>
                    <td><a href='itemdetalles.php?item_id=$id_item&item_nombre=$nom_item'>$nom_item</a></td>
                    <td>PRECIO FINAL: $precio_final €</td>
                    <td>Ganador: $ganador</td>
                    </tr>";
                }
                ?>
            <tr><td colspan="4"><input type="submit" value="BORRAR" name="borrar" class="btn-enviar"></tr></td>
        </table>
    </form>
    <?php require("pie.php"); ?>

</body>
</html>