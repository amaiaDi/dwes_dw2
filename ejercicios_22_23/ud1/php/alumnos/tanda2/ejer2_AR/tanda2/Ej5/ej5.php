<?php   

    function validarNum(){
        if (isset($_POST['txtNum'])){
            $_POST['txtNum'] = trim($_POST['txtNum']);
            if ($_POST['txtNum']== "" || !is_numeric($_POST['txtNum'])){
                return false;
            }
        }
        return true;
    }

    function leerConversor() {
        $file = fopen('./utils/utils.txt',"r");
        $factor = fscanf($file, '%f');
        return $factor[0];
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor</title>
</head>
<body>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td>
                    <label for="txtNum">Cantidad:</label>  
                    
                    
                    

                    <?php
                        if (isset($_POST['txtNum']))
                            echo '<input type="text" name="txtNum" id="txtNum" value="'.$_POST["txtNum"].'">';
                        else
                            echo '<input type="text" name="txtNum" id="txtNum">';

                        if (!validarNum()){
                            if ($_POST['txtNum']== "")
                                echo '<span style = "color: red;">¡VACIO!</span>';
                            else
                                echo '<span style = "color: red;">¡NO NUMERICO!</span>';
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($_POST['conv'] == "dolEur"){
                            echo '<input type="radio" id="eurDol" name="conv" value="eurDol">
                            <label for="eurDol">Euros a dolares</label>
        
                            <input type="radio" id="dolEur" name="conv" value="dolEur" checked>
                            <label for="dolEur">Dolares a euros</label>';

                        }else{
                            echo '<input type="radio" id="eurDol" name="conv" value="eurDol" checked>
                            <label for="eurDol">Euros a dolares</label>
        
                            <input type="radio" id="dolEur" name="conv" value="dolEur">
                            <label for="dolEur">Dolares a euros</label>';
                        }
                    ?>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        if (validarNum()){
                            if (isset($_POST['convertir'])){
                                if ($_POST['conv'] == "dolEur")
                                    echo "<p>".bcdiv(floatval($_POST['txtNum'])*leerConversor(), 1 ,2)."€</p>";
                                else
                                    echo "<p>".bcdiv(floatval($_POST['txtNum'])/leerConversor(), 1 ,2)."$</p>";
                            }
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="CONVERTIR" name="convertir">
                </td>
            </tr>
        </table>
   </form>
</body>
</html>