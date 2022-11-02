<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
        $arrProductos = array();
        $presio;

        function crearTabla(){
            global $presio;
            global $arrProductos;
            $lineaTabla = "";
            $fp = fopen("pedido.txt", "r");
            while (!feof($fp)){
                $linea = fgets($fp);
                array_push($arrProductos, $linea);
                $arr = array($linea);
                $arr = explode(";", $linea);
                $lineaTabla = $lineaTabla."<tr> <td>$arr[0]</td> <td>$arr[1]</td> <td><a href='pedido.php?precioProducto=$arr[1]&precioTotal=$presio'>Añadir unidad</a></td> </tr>";
            }
            fclose($fp);
            return $lineaTabla;
        }

        if(isset($_GET['precioProducto'])){
            global $presio;
            $presioProducto = $_GET['precioProducto'];
            $presioTotal = $_GET['precioTotal'];
            $presio = $presioTotal + $presioProducto;
        }else{
            global $presio;
            $presio = 0;
        }

        $nombreForm = "";
        $precioForm = "";

        $rutaActual = getcwd();

        if(isset($_POST['Añadir'])){
            $nom = $_POST['nombreForm'];
            $pre = $_POST['precioForm'];

            file_put_contents("pedido.txt", "\n".$nom.";".$pre, FILE_APPEND);

            global $rutaActual;
            $fich = $_POST['archivosubido'];

        }

        function leerNombreProducto($nomFich){
            $nom;
            $fp = fopen($nomFich, "r");
            while (!feof($fp)){
                $linea = fgets($fp);
                $arr = array($linea);
                $arr = explode(";", $linea);
                $nom = $arr[0];
            }
            return $nom;
        }




    ?>
    <body>        
            <h2>ELIGE TU PEDIDO</h2>           
            <table>
                <?php echo crearTabla() ?>
            </table>
            <h2>TOTAL: <?php echo $presio ?> €</h2> 
            
            <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <h2>AÑADE ARTICULO</h2>
                        Nombre:
                        <input type="text" name="nombreForm" value="<?php echo $nombreForm; ?>" />
                        Precio:
                        <input type="text" name="precioForm" value="<?php echo $precioForm; ?>" />
                        <input type="submit" value="Añadir" name="Añadir"/>
                        <br>
                        <input type="file" name="archivosubido">
            </form>
    </body>
</html>