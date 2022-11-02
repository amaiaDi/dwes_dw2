<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
        body{
            text-align:center;
            margin:auto;
        }
        table{
            margin:auto;
        }
        .final{
            position: absolute;
            bottom: 50px;
            left: 30em;
        }
        th{
            padding-right:100px;
            padding-left:100px;
            background-color: rgba(204, 204, 204, 0.407);
            
        }
    </style>
    <body>
        
        <table>
            <tr>
                <th colspan="3">ELIGE TU PEDIDO</th>
            </tr>
            
            <?php
                $cantidad=0;
                function leerText($cantidad){
                    $cont=0;
                    $fp = fopen("articulos.txt", "r");

                    while(!feof($fp)) {
                        $cont++;
                        $linea = fgets($fp);
                        $nombre=strstr($linea,";",true);
                        $precio=strstr($linea,";");
                        $precio=substr($precio,1);
                        $precio=trim($precio);
                        if (($nombre!="" || $precio!="")) {
                        echo "<tr><td>$nombre</td><td>".$precio."€</td><td><a href='pedido.php?suma=$precio&cantidad=$cantidad'>Añadir unidad</a></td></tr>";
                        }
                    }

                    fclose($fp); 
                }
                
                function calcular(){
                    $suma=$_GET['suma'];
                    $cantidad=$_GET['cantidad'];
                    $suma+=0;
                    $cantidad+=$suma;
                    return $cantidad;
                }
                if (isset($_GET['suma'])) {
                    $cantidad=calcular();
                }
                
                
                $nombre="";
                $precio="";

                if (isset($_POST['aniadir']) && !empty($_POST['precio']) && !empty($_POST['nombre'])) {
                    $precio = $_POST['precio'];
                    $nombre = $_POST['nombre'];
                    $fp = fopen("articulos.txt", "a+");
                    $datos = $nombre.";".$precio;
                    $datos=$datos."\n";
                    fputs($fp, $datos);
                    fclose($fp);

                    leerText($cantidad);

                    $file = $_FILES["archivo"]["name"];

                    $url_temp = $_FILES["archivo"]["tmp_name"]; 

                    $url_insert = dirname(__FILE__) . "/files"; 

                    $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

                    if (!file_exists($url_insert)) {
                        mkdir($url_insert, 0777, true);
                    };

                    if (move_uploaded_file($url_temp, $url_target)) {
                        echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
                    } else {
                        echo "Ha habido un error al cargar tu archivo.";
                    }
                }else {
                    leerText($cantidad);
                }
            ?>
            
            <tr>
                <th colspan="3">TOTAL: 
                    <?php   
                        echo $cantidad;
                    ?>€
                </th>
            </tr>
        </table>
        <table class="final">
            <tr>
                <th colspan="3">AÑADE ARTICULO</th>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td>Precio(€):</td>
            </tr>
            <tr>
                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <td><input type="text" name="nombre"></td>
                    <td><input type="text" name="precio"></td>
                    <td><input type="submit" name="aniadir" value="AÑADIR"></td>
                    <td><input type="file" name="archivo" id="archivo"></td>
                    <?php
                        if (isset($_POST['aniadir']) && empty($_POST['nombre'])){
                            echo "<td> *Debe introducir un nombre</td>";
                        }
                        if (isset($_POST['aniadir']) && empty($_POST['precio'])){
                            echo "<td> *Debe introducir un precio</td>";
                        }
                        
                    ?>
                </form>
            </tr>
        </table>
        
    </body>
</html>