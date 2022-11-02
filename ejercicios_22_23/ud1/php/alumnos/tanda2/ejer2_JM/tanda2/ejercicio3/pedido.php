<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artículos</title>
</head>
<body>
    
</body>
</html>


<?php

function obtenerProductos(){
    $productos = [];
    $handle = fopen("archivos_articulos/articulos.txt","r");
    while(!feof($handle)){
        $linea = fgets($handle);
        $partes = explode(";",$linea);
        if(isset($partes[1])){
            $arr_partes = array($partes[0] => $partes[1]);
            array_push($productos,$arr_partes);
        }
    }
    fclose($handle);
    return $productos;
}

function aniadirProducto($nombre,$precio){
    $handle = fopen("archivos_articulos/articulos.txt","a");
    fwrite($handle,"$nombre;$precio" . PHP_EOL);
    fclose($handle);
}

function tieneCaracteristicas($nombre_articulo){
    $arr_articulos_txt = scandir('archivos_articulos');
    if(in_array($nombre_articulo.'.txt',$arr_articulos_txt)){
        return true;
    }
    return false;
}

if(isset($_POST['nom']) && isset($_POST['pre'])){
    if($_POST['nom'] !=='' && $_POST['pre'] !==''){

        aniadirProducto($_POST['nom'],$_POST['pre']);

        if(isset($_FILES['archivo_texto']['tmp_name'])){
            $dir_tmp = $_FILES['archivo_texto']['tmp_name'];
            move_uploaded_file($dir_tmp,'archivos_articulos/'. $_POST['nom'] . '.txt');
        }
    }
}

$productos = obtenerProductos();

if(isset($_GET["envio"])){
    $total =  $_GET["tot"] + $_GET["envio"];
}
else{
    $total = 0;
}

echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Pedido</title>
    <link rel='stylesheet' href='pedido.css'>
</head>
";

echo "<body> <div><h2>ELIGE TU PEDIDO</h2>
    <table>";

foreach($productos as $producto){
    echo "<tr>";
        $nombre_producto = array_keys($producto);
        foreach($nombre_producto as $nom){
            echo "
                <td>$nom</td>    
                <td>$producto[$nom]€</td>
                <td><a href='pedido.php?envio=$producto[$nom]&tot=$total'>Añadir unidad</a></td>";
                if(tieneCaracteristicas($nom)){
                    echo "<td><a href='archivos_articulos/$nom.txt'>Características</a></td>";
                }
                echo "
            ";
        }
    
    echo "</tr>";

}

echo "</table>
<p>TOTAL: $total €</p>

</div>";

echo "
<div>
    <h2>AÑADE ARTICULO</h2>
    <form action='pedido.php' method='post' enctype='multipart/form-data'>
        <label for='nom'>Nombre:</label>
        <label for='pre' id='lbl-precio'>Precio(€):</label><br>
        <input type='text' name='nom' id='nom'>
        <input type='text' name='pre' id='pre'>
        <input type='submit' value='AÑADIR' name='aniadir'><br><br>
        Archivo con las características del producto:
        <input type='file' name='archivo_texto' accept='.txt' class='archivo'>
    </form>
</div>

</body></html>";


?>

