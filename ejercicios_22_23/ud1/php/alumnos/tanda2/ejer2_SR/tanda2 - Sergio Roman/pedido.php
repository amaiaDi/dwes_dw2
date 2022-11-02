<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
</head>
<body>
    <table>
        <caption style='background-color:lightgrey'><strong>ELIGE TU PEDIDO</strong></caption>
    <?php
        $arrArt;
        $precio = 0;
        $fp = fopen('ficheros/articulos.txt', "r");
        if(isset($_GET["variable1"]))
        {
            $precio = $_GET["variable1"];
        }
        if(isset($_GET["variable"]))
        {
            $precio += $_GET["variable"];
        }
        if(isset($_POST["nuevoArt"]))
        {
            if(!empty($_POST['nomArt']) && !empty($_POST['precioArt']))
            {
                $file = fopen('ficheros/articulos.txt', "a+");
                $nomArt = $_POST['nomArt'];
                $precioArt = $_POST['precioArt'];
                fwrite($file, "\n$nomArt;$precioArt");
                fclose($file);
                if(!empty($_FILES['uploadedFile']['tmp_name']))
                {
                    $ficheroTemporal = $_FILES['uploadedFile']['tmp_name'];
                    $nombreFicheroNuevo = 'ficheros/caracteristicas/' . $nomArt . '.txt';
                    rename($ficheroTemporal, $nombreFicheroNuevo);
                }
            }
        }
        while(!feof($fp))
        {
            $linea = fgets($fp);
            if(!empty($linea))
            {
                $arrArt = explode(';', $linea);
                echo "<tr>
                            <td>$arrArt[0]</td>
                            <td>$arrArt[1]€</td>
                            <td><a href='pedido.php?variable=$arrArt[1]&&variable1=$precio'>Añadir unidad</a></td>";
                        $dir = opendir("ficheros/caracteristicas");
                        for($c = 0; $elemento = readdir($dir);  $c++)
                        {
                            if($elemento == $arrArt[0] . '.txt')
                            {
                                echo "<td><a href='ficheros/caracteristicas/$elemento'>$elemento</a></td>";
                                break;
                            }
                        }
                        echo "<tr>";
            }
        }
        fclose($fp);
        echo "<tr style='background-color:lightgrey'>
                <td style='text-align:center' colspan='3' ><strong>TOTAL: {$precio}€</strong></td>
            </tr>";
    echo "</table>
        <form action='pedido.php?variable1=$precio' method='post' enctype='multipart/form-data'>
        <table>
            <caption style='background-color:lightgrey'><strong>AÑADE ARTICULO</strong></caption>
                <tr>
                    <td>Nombre:</td>
                    <td>Precio(€):</td>
                </tr>
                <tr>
                    <td><input type='text' name='nomArt' id='nom' size='10'></td>
                    <td><input type='text' name='precioArt' id='precio' size='10'></td>
                    <td><button type='submit' name='nuevoArt'>AÑADIR</button></td>
                </tr>
                <tr>
                    <td colspan='3'><input type='file' name='uploadedFile' id='file' size='10'></td>
                </tr>
        </table>
    </form>";
    ?>
</body>
</html>