<?php
   function llenarTabla (){
        $total = isset($_GET["total"]) ? $_GET["total"] : 0;
        $f = fopen ("./files/articulos.txt", "r");
        
        if ($f) {
            while (($line = fgets($f)) !== false) {
                $txt = explode (";", $line);
                echo "<tr>";
                echo "<td>".$txt[0]."</td>";
                echo "<td>".$txt[1]."</td>";
                echo "<td><a href='?total=". ( $GLOBALS['total'] + floatval($txt[1])) . "'>Añadir unidad</a></td></tr>";

            }
            fclose($f);
        }
    }

    function aniadirArticulo (){
        $f = fopen ("./files/articulos.txt", "a");
        if ($f && isset($_POST['aniadir'])){
           $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
           $precio = isset($_POST["precio"]) ? $_POST["precio"] : 0;

           $txt = "\n".$nombre.";".$precio;
           fwrite($f, $txt);
        }
        fclose($f);
    }
    aniadirArticulo();
    $GLOBALS['total'] = isset($_GET["total"]) ? $_GET["total"] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <title>Pedido</title>
</head>
<body>
    <table>
        <caption>ELIGE TU PEDIDO</caption>
        <?php
            llenarTabla ();
            echo "<td id='total' colspan = '3'> TOTAL: ". $GLOBALS['total']."€</td>";
        ?>
    </table>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <caption>AÑADE ARTICULO</caption>
            <tr>
                <td>Nombre:</td>
                <td>Precio(€):</td>
            </tr>
            <tr>
                <td><input type="text" name="nombre"></td>
                <td><input type="text" name="precio"></td>
                <td><input type="submit" name="aniadir" value="AÑADIR"></td>
            </tr>
        </table>
    </form>
</body>
</html>