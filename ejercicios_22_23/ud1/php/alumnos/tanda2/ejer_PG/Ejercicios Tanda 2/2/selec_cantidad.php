<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
function cuantasImag(){
    $DIRIMG = opendir("imagenes/");
    print '<select name="num" id="num">';
    $cont=1;
    while($listar_d = readdir($DIRIMG)) {
        if ($listar_d[0] != "." && $listar_d[0] != ".." ){
            if($cont!=1){
                echo "<option name='a' id='a' value='$cont'>$cont</option>";
            }
            $cont++;
        }
        
    }
    $_SESSION["cont"]=$cont;
    print '</select>';
    closedir($DIRIMG);
    
}
if(isset($_POST["num"])){
    header("location: eval_imag.php");
    $_SESSION["archivo"]=$_POST["num"];
}
?>


<form action="selec_cantidad.php" method="post">
<?php
cuantasImag();
?>

<button type="submit" name="log" value="b" id="log">Añadir</button>



</body>
</html>