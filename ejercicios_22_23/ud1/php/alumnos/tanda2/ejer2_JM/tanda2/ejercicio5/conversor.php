<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor</title>
</head>
<body>
<?php

function convertirMoneda($cantidad, $tipo){
    // 1 euro -> 0.99 dolares
    $handle = fopen("factor_conversion.txt","r");
    $arr_factor = fscanf($handle,"%f");
    $factor = $arr_factor[0];
    fclose($handle);
    if($tipo == "eur_dol"){
        $conversion = $cantidad * $factor;
    }
    else{
        $conversion = $cantidad / $factor;
    }
    return $conversion;
}

$checked_euros = "checked";
$checked_dolares = "";
$cantidad = "";
$error = "";
if(isset($_POST['cantidad'])){
    $cantidad = $_POST['cantidad'];
    if($cantidad == ""){
        $error = "¡VACÍO!";
    }
    elseif(!is_numeric($cantidad)){
        $error = "¡NO NUMÉRICO!";
    }
    else{
        $error = "";
        $resultado = round(convertirMoneda($cantidad, $_POST['moneda']),2);
    }
    if($_POST['moneda'] == 'eur_dol'){
        $moneda = '$';
        $checked_euros = "checked";
        $checked_dolares = "";
    }
    else {
        $moneda = '€';
        $checked_dolares = "checked";
        $checked_euros = "";
    }
}
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>"  name="enviar" method="post">
    <label for="cantidad">Cantidad:</label>
    <?php
    echo "
    <input type='text' name='cantidad' value='$cantidad'>
    <label for='cantidad'><font color='red'>$error</font></label>
    <input type='radio' name='moneda' value='eur_dol' $checked_euros>";
    ?>
    <label for="eur_dol">Euros a dólares</label>
    <?php
    echo "<input type='radio' name='moneda' value='dol_eur' $checked_dolares>"
    ?>
    <label for="dol_eur">Dólares a euros</label>
    <?php
    if(isset($resultado)){
        echo "<p><strong>$resultado  $moneda</strong></p>";
    }
    ?>
    <br><br><input type="submit" name="enviar_cantidad" value="CONVERTIR">
</form>
    
</body>
</html>