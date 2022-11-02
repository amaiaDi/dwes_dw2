<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conversor</title>
</head>
<body>
    
        <?php
            $cant = '';
            $result = '';
            $radio = 'Euro-Dolar';
            if(isset($_POST['cant']))
            {
                $cant = $_POST['cant'];
            }
            echo "<form action='conversor.php' method='post'>
            <table>
                <tr>
                    <td rowspan='2'><label for='radio'>Cantidad:</label> <input type='text' name='cant' value='$cant'></td>";

                    if(isset($_POST['convertir']))
                    {
                        if(empty($cant))
                        {
                            echo "<td rowspan='2' style='color:red'>¡VACÍO!</td>";
                        }
                        elseif(!is_numeric($cant))
                        {
                            echo "<td rowspan='2' style='color:red'>¡NO NUMERICO!</td>";
                        }
                        else
                        {
                            $radio = $_POST['radio'];
                            if($_POST['radio'] == 'Euro-Dolar')
                            {
                                $result = $cant * 0.99;
                                $result .= "$";
                            }
                            else
                            {
                                $result = $cant / 0.99;
                                $result .= "€";
                            }
                            $fp = fopen("ficheros/factor_conversion.txt", "a+");
                            $linea = $cant . ";" . $_POST['radio'] . ";" . $result . "\n";
                            fwrite($fp, $linea);
                            fclose($fp);
                        }
                    }

            echo "<td><input type='radio' name='radio' value='Euro-Dolar'";
            if($radio == 'Euro-Dolar')
            {
                echo "checked";
            }
            echo"><label for='radio'>Euros a dólares</label></td>
                </tr>
                <tr>
                    <td><input type='radio' name='radio' value='Dolar-Euro'";
                    if($radio == 'Dolar-Euro')
                    {
                        echo "checked";
                    }  
            echo "><label for='radio'>Dólares a euros</label></td>
                </tr>
            </table>";

            echo "<h1>$result</h1>";
        ?>
        <button type="submit" name="convertir">CONVERTIR</button>
    </form>
</body>
</html>