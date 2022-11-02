<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de divisas</title>
</head>
<body>
    <?php
        $cantidad = '';
        $conversion  = '';
        $formato = 'Euro-Dolar';
        if(isset($_POST['cant']))
        {
            $cantidad = $_POST['cant'];
            if(is_numeric($cantidad))
            {
                if($_POST['radioButton'] == 'Euro-Dolar')
                {
                    $conversion = $cantidad * 0.99;
                    $conversion = $conversion . '€';
                }
                else
                {
                    $formato = 'Dolar-Euro';
                    $conversion = $cantidad / 0.99;
                    $conversion = $conversion . '$';
                }
            }
            $file = fopen('ficheros/factorConversion.txt', 'a+');
            $linea = $cantidad . ';' . $_POST['radioButton'] . ';' . $conversion . "\n";
            fwrite($file, $linea);
            fclose($file);
        }
        echo "<form action='conversor.php' method='post'>
            <table>
                <tr>
                    <td rowspan='2'><label for='cant'>Cantidad:</label></td>
                    <td rowspan='2'><input type='text' name='cant' value='$cantidad'></td>";

                    if(isset($_POST['conver']))
                    {
                        if($cantidad == '')
                        {
                            echo "<td rowspan='2' style='color:red'><label for='error'>¡VACIO!</label></td>";
                        }
                        elseif(!is_numeric($cantidad))
                        {
                            echo "<td rowspan='2' style='color:red'><label for='error'>¡NO NUMERICO!</label></td>";
                        }
                    }

                    echo "<td><input type='radio' name='radioButton' value='Euro-Dolar'"; if($formato == 'Euro-Dolar')
                    {
                        echo "checked";
                    } 
                    echo"></td>
                    <td><label for='Euro-Dolar'>Euros a dolares</label></td>
                </tr>
                <tr>
                    <td><input type='radio' name='radioButton' value='Dolar-Euro'"; if($formato == 'Dolar-Euro')
                    {
                        echo "checked";
                    }
                    echo"></td>
                    <td><label for='Dolar-Euro'>Dolares a euros</label></td>
                </tr>
            </table>
            <h1>$conversion</h1>
            <input type='submit' name='conver' value='CONVERTIR'>
        </form>";
    ?>
</body>
</html>