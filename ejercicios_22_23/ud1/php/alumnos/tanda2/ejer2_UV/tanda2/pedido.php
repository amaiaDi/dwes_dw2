<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pedido</title>
</head>
<body>
    <table>
        <tr style='background-color:lightgrey'>
            <th colspan="3">ELIGE TU PEDIDO</th>
        </tr>
    
    <?php
        
        $arr;
        $num = 0;
        if(isset($_GET['variable1']))
        {
            $num = (double)$_GET['variable1'];
            if(isset($_GET['variable']))
            {
                $num += $_GET['variable'];
            }
        }
        $fp = fopen("ficheros/articulos.txt", "r");
        while(!feof($fp))
        {
            $linea = fgets($fp);
            if(!empty($linea))
            {
                $arr = explode(";", $linea);
                echo "<tr>
                        <td>$arr[0]</td>
                        <td>$arr[1]€</td>
                        <td><a href='pedido.php?variable=$arr[1]&variable1=$num'>Añadir unidad</a></td>";
                if(count($arr)>2)
                {
                    echo "<td><a href='ficheros/$arr[0].txt'>$arr[0].txt</a></td> </tr>";
                }
            }
        }
        fclose($fp);
        
        echo "<tr style='background-color:lightgrey'>
                <th colspan='3'>TOTAL: $num €</th>
              </tr>";

        echo "</table>
        <form action='pedido.php?variable1=$num' method='post' enctype='multipart/form-data'>
            <table>
                <tr style='background-color:lightgrey'>
                    <th colspan='3'>AÑADE ARTICULO</th>
                </tr>
                <tr>
                    <td><label for='nombre'>Nombre:</label></td>
                    <td><label for='precio'>Precio(€):</label></td>
                </tr>
                <tr>
                    <td><input type='text' name='nombre' id='nom'></td>
                    <td><input type='text' name='precio' id='pre'></td>
                    <td><button type='buttom' name='add'>AÑADIR</button></td>
                </tr>
                <tr>
                    <td colspan='3'><label for='fichero'>Archivo del articulo  </label><input type='file' name='fichero'></td>
                </tr>
            </table>
        </form>";

        if(isset($_POST['add']))
        {
            if(!empty($_POST['nombre']) && !empty($_POST['precio']))
            {
                $fp = fopen("ficheros/articulos.txt", "a+");
                $nombre = $_POST['nombre'];
                $linea = $nombre . ";" . $_POST['precio'] . "\n";
                
                if(isset($_FILES['fichero']))
                {
                    $tipoFich = $_FILES['fichero']['name'];
                    $tipoFich = substr($tipoFich, strpos($tipoFich, '.')+1);
                    if($tipoFich != "txt")
                    {
                        echo "Su archivo no es un txt";
                    }
                    else
                    {
                        if(move_uploaded_file($_FILES['fichero']['tmp_name'], "ficheros/$nombre.txt"))
                        {
                            $linea = $nombre . ";" . $_POST['precio'] . ";" . "$nombre.txt" . "\n";
                        }
                        else
                        {
                            echo "No se ha podido guardar tu fichero";
                        }  
                        
                    }
                }
                fwrite($fp, $linea);
                fclose($fp);
                header("Location: pedido.php?variable1=$num");
            }
        }


    ?>
    


</body>
</html>