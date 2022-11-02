<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: arial;
        }

        table {
            border: solid 1px black;
        }

        #conversion {
            font-size: 3em;
        }

        .error {
            color: red;
        }

    </style>
    <title>Document</title>
</head>
<body>
    <?php
        function convertir($op) {
            $factorFich = fopen("factor.txt","r");
            while ($factor = fscanf($factorFich, "%s\t%s\n")) {
                list ($facNom, $facVal) = $factor;
                if ($op==$facNom) {
                    return $facVal;
                }
            }
            fclose($factorFich);
        }
    ?>
    <form action="conversor.php" method="post">
        <table>
            <tr>
                <td rowspan="2">Cantidad:</td>
                <td rowspan="2"><input type="text" name="num" id="num" value="<?php echo $cantidad = isset($_POST['num']) ? $_POST['num'] : '';?>"><label class="error" for="num"><?php echo $error = isset($_GET['error']) ? $_GET['error'] : '';?></label></td>
                <td><input type="radio" name="aQue[]" id="eurusd" value="eu" checked><label for="eurusd">euro a dolar</label></td>
            </tr>
            <tr>
                <td><input type="radio" name="aQue[]" id="usdeur" value="ue"><label for="usdeur">dolar a euro</label></td>
            </tr>
        </table>
        <?php
            if (isset($_POST['convertir'])) {
                $num = $_POST['num'];
                if ($num==null) {
                    header("Location: conversor.php?cantidad=$num&error=¡VACIO!");
                } elseif (!is_numeric($num)) {
                    header("Location: conversor.php?cantidad=$num&error=¡NO NUMERICO!");
                } else {
                    $conversion = $_POST['num']*convertir($_POST['aQue'][0]);
                    echo "<div id='conversion'>" . $conversion . "€</div><br>";
                }
                
            }
        ?>
        <input type="submit" value="CONVERTIR" name="convertir">
    </form>
</body>
</html>