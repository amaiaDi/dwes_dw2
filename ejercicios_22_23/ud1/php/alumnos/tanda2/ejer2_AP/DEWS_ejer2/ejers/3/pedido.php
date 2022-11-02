<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
        }

        th {
            background-color: lightgray;
        }

        table {
            margin: 10px 10px 30px 10px;
            width: 350px;
        }

        input.inp {
            width: 10em;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th colspan="3">ELIGE TU PEDIDO</th>
        </tr>
        <?php error_reporting (E_ALL ^ E_NOTICE);
            $total;
            if ($_GET['total']==null) {
                $total=0;
            } else {
                $total = $_GET['total'];
                $total += $_GET['precio'];
            }
            
            $fichero = fopen("articulos.txt","r");
            while (!feof($fichero)) {
                $linea = fgets($fichero);
                $nombre = substr($linea,0,strrpos($linea,';'));
                $precio = substr($linea,strrpos($linea,';')+1);
                echo "<tr>";
                echo "<td>$nombre</td>";
                echo "<td>".$precio."€</td>";
                echo "<td><a href='pedido.php?precio=$precio&total=$total'>Añadir unidad</a></td>";
                echo "</tr>";
            }
            fclose($fichero);

            if (isset($_POST['anadir'])) {
                $fichero = fopen("articulos.txt","a");
                $str = "\n" . $_POST['name'] . ";" . $_POST['precio'];
                fwrite($fichero, $str);
                fclose($fichero);
                header("Location: pedido.php");
            }
        ?>
        <tr>
            <th colspan="3">TOTAL: <?php echo $total ?>€</th>
        </tr>

        <table>
            <tr>
                <th colspan="3">AÑADE ARTICULO</th>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td>Precio(€):</td>
                <td></td>   
            </tr>
            <tr>
                <form action="pedido.php" method="post">
                    <td><input class="inp" type="text" size="15" name="name" required/></td>
                    <td><input class="inp" type="number" size="10" step="0.01" name="precio" required/></td>
                    <td><input type="submit" value="AÑADIR" name="anadir"></td>
                </form>
            </tr>
        </table>
    </table>
</body>
</html>