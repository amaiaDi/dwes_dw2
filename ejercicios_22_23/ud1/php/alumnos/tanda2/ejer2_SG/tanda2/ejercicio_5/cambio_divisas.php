<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 5</title>
</head>
<body>
    <main>
        <form action="cambio_divisas.php" method="post">
            <table>
                <tr>
                    <td>
                        <label for="cantidad">Cantidad: </label>
                        <input type="text" name="cantidad" id="cantidad"
                            <?php
                                if(isset($_POST["convertir"]) && !empty($_POST["cantidad"])){
                                    echo "value=".$_POST["cantidad"];
                                }
                            ?>
                        >
                        <?php
                            if(isset($_POST["convertir"])){
                                echo $error = empty($_POST["cantidad"])? "<td><p style='color:red'>¡VACIO!</p></td>":
                                (!is_numeric($_POST["cantidad"])? "<td><p style='color:red'>¡NO NUMERICO!</p></td>":"");
                            } 
                        ?>
                    </td>
                    <td>
                        <input type="radio" name="cambio_divisa" id="euro_dolar" value="euro_dolar" 
                        <?php 
                            if(empty($_POST["cambio_divisa"]))
                                echo "checked";
                            else if($_POST["cambio_divisa"] == "euro_dolar")
                                echo "checked";
                        ?>
                        >
                        <label for="euro_dolar">Euros a dolares</label><br>
                        <input type="radio" name="cambio_divisa" id="dolar_euro" value="dolar_euro"
                        <?php 
                            if($_POST["cambio_divisa"] == "dolar_euro")
                                echo "checked";
                        ?>
                        >
                        <label for="dolar_euro">Dolares a euros</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p style="font-size:2rem">
                            <b>
                            <?php 
                                if(isset($_POST["convertir"]) && !empty($_POST["cantidad"]) && is_numeric($_POST["cantidad"])){
                                    $archivo = fopen("../ficheros_ejercicio2_5/conversion_euro-dolar.txt","r");
                                    while ($cambio_divisas = fscanf($archivo, "%s\t%s\t%s\n")) {
                                        list ($nombre, $cambio,$signo) = $cambio_divisas;
                                        if($_POST["cambio_divisa"] == $nombre){
                                            echo $cantConvertido = ($_POST["cantidad"] * $cambio) .$signo;
                                        }
                                    }
                                    fclose($archivo);
                                }
                            ?>
                            </b>
                        </p>
                    </td>
                </tr>
                <tr colspan="2">
                    <td><input type="submit" name="convertir" value="CONVERTIR"></td>
                </tr>
            </table>
        </form>
    </main>
</body>
</html>