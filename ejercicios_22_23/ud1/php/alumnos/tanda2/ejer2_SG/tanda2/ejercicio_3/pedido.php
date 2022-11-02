<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <main>
        <?php
            //Para elegir tu pedido
            $precio_Total = 0;
            if(isset($_GET["precio_total"])){
                $precio_Total = $_GET["precio_total"];
            }
            if(isset($_GET["precio"])){
                $precio_Total = $precio_Total + $_GET["precio"];
            }
            echo "<table><tr><th colspan='3' style='background-color:lightgrey'>ELIGE TU PEDIDO</th></tr>"; 
            $archivo = fopen("../ficheros_ejercicio2_5/articulos.txt","r");
            while (!feof($archivo)) {
                echo "<tr>";
                $linea = fgets($archivo);
                $artculo = substr($linea,0,strpos($linea,";"));
                $precio = substr($linea,strpos($linea,";")+1);
                $precio = str_replace(",",".",$precio);
                echo "<td>". $artculo ."</td> <td>".$precio."€  </td><td><a href='pedido.php?precio=".$precio."&precio_total=".$precio_Total."'>añadir unidad</a></td>";
                echo "</tr>";
            }
            echo "<tr><th colspan='3' style='background-color:lightgrey'>TOTAL: ".$precio_Total."€</th></tr></table>";
            //añade articulo
        ?>
        <form action="pedido.php" method="post" style="margin-top: 15px">
            <table>
                <tr>
                    <th colspan="3" style='background-color:lightgrey'>AÑADE ARTICULO</th>
                </tr>
                <tr>
                    <td><label for="nombre">Nombre:</label></td>
                    <td colspan="2"><label for="precio">Precio(€):</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="nombre" id="nombre"></td>
                    <td><input type="text" name="precio" id="precio" pattern="[0-9.,]+"></td>
                    <td><input type="submit" name="aniadir" value="AÑADIR"></td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST["aniadir"])){
                if(!empty($_POST["nombre"])&& !empty($_POST["precio"])){
                    aniadirArticulo($_POST["nombre"],$_POST["precio"]);
                    header("Location: pedido.php");
                }
            }
            function aniadirArticulo($nombre, $precio){
                $archivo = fopen("../ficheros_ejercicio2_5/articulos.txt","a");
                $precio = str_replace(",",".",$precio);
                fwrite($archivo,"\n".$nombre.";".$precio);
                fclose($archivo);
            }
        ?>
    </main>
</body>
</html>