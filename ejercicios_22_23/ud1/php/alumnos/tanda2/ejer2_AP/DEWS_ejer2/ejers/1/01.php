<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="01.php" method="POST">
        <table>
            <tr>
                <td><label for="txtCif">Texto a Cifrar</label></td>
                <td><input type="text" id="txtCif" name="txtCif"/></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="radio" name="desp" value="<?php echo despNums(0) ?>"><?php echo despNums(0) ?></td>
                <td></td>
            </tr>
            <tr>
                <td><label for="">Desplazamiento</label></td>
                <td><input type="radio" name="desp" value="<?php echo despNums(1) ?>"><?php echo despNums(1) ?></td>
                <td><input type="submit" value="CIFRADO CESAR" name="cif"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="radio" name="desp" value="<?php echo despNums(2) ?>"><?php echo despNums(2) ?></td>
                <td></td>
            </tr>
            <tr>
                <td><label for="">Fichero de clave</label></td>
                <td>
                    <select name="fichs" id="fichs">
                        <option value="../txt/fichero_clave1.txt">fichero_clave1.txt</option>
                        <option value="../txt/fichero_clave2.txt">fichero_clave2.txt</option>
                    </select>
                </td>
                <td><input type="submit" value="CIFRADO POR SUSTITUCION" name="cifSus"></td>
            </tr>
        </table>
    </form>
    <?php
        function despNums($num) {
            $arr = array(3,5,10);
            return $arr[$num];
        }
        
        function cifradoCesar() {
            $txt = $_POST['txtCif'];
            $txtFinal = "";
            $desp = $_POST['desp'];
            $i = 0;
            while ($i < strlen($txt)) {
                $char = $txt[$i];
                for ($j = 1; $j <= $desp; $j++) {
                    if ($char == "z") {
                        $char = 'a';
                        $j++;
                    }
                    if ($char == "Z") {
                        $char = 'A';
                        $j++;
                    }
                    $char = ++$char;
                }
                $txtFinal = $txtFinal . $char;
                $i++;
            }
            echo "Text cifrado: " . $txtFinal;
        }

        function cifradoSus() {
            $fichero = $_POST['fichs'];
            $txt = $_POST['txtCif'];
            $handle = fopen($fichero, "r");
            while (!feof($handle)) {
                $linea = fgets($handle);
            }
            fclose($handle);
            $i = 0;
            while ($i < strlen($txt)) {
                $txt[$i] = $linea[ord($txt[$i])-65];
                $i++;
            }
            echo "Text cifrado: " . $txt;
        }

        if(isset($_POST['cif'])) {
            try {
                cifradoCesar();
            } catch (Exception $e) {
                echo $e;
            }
        }

        if(isset($_POST['cifSus'])) {
            try {
                cifradoSus();
            } catch (Exception $e) {
                echo $e;
            }
        }
        
    ?>
</body>
</html>