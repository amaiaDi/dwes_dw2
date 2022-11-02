<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
        body{
            text-align:center;
            margin:auto;
        }
        form,table{
            margin:auto;
        }
        img{
            width:150px;
            height:150px;
            margin:auto;
        }
    </style>
    <body>
        <?php
            $arrmodulos = array();
            if (isset($_POST['enviar'])){
                if (isset ($_POST['modulos'])){
                    $fp = fopen("likes.txt", "a+");
                    $arrmodulos = $_POST['modulos'];
                    function getRealIP() {
                        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                            return $_SERVER['HTTP_CLIENT_IP'];
                        }
                        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                            return $_SERVER['HTTP_X_FORWARDED_FOR'];
                        }
                        return $_SERVER['REMOTE_ADDR'];
                    }
                    $datos = getRealIP().": ";
                    foreach ($arrmodulos as $modulo) {
                        $datos=$datos." ".$modulo." ";
                    }
                    $datos=$datos."\n";
                    fputs($fp, $datos);
                    fclose($fp);
                    echo "<p>Gracias!!</p><br>
                        <a href='selec_cantidad.php'>Volver al inicio</a>";
                }
                else{
                    echo "<p>Sentimos que no le haya gustado ninguna</p><br>
                        <a href='selec_cantidad.php'>Volver al inicio</a>";
                }
            }
            else 
            {
        ?>
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <?php
                    if(isset($_SESSION['numSelec'])) {
                        $numSelec= $_SESSION['numSelec'];
                    }
                    if(isset($_SESSION['ruta'])) {
                        $ruta= $_SESSION['ruta'];
                    }
                    if(isset($_SESSION['numsTotal'])) {
                        $numsTotal= $_SESSION['numsTotal'];
                    }   
                    $dir = opendir($ruta);
                    $cont=1;
                    $contF=0;
                    $arrayNums=array();
                    for ($i=0; $i < $numSelec; $i++) { 
                        $numRandom=random_int(1,$numsTotal);
                        $esta=false;
                        for ($i2=0; $i2 < count($arrayNums); $i2++) { 
                            if ($arrayNums[$i2]==$numRandom) {
                                $esta=true;
                            }
                        }
                        if ($esta) {
                            $i--;
                        }
                        else {
                            $arrayNums[$i]=$numRandom;
                        }
                    }
                    sort($arrayNums);
                    while ($elemento = readdir($dir)){
                        if($elemento != "." && $elemento != ".."){
                            if ($contF!=count($arrayNums) && $cont==$arrayNums[$contF]) {
                                echo "<tr>";
                                echo"<td><img src='imagenes/$elemento' alt='img'></td>";
                                echo "<td><input type='checkbox' name='modulos[]' value='$elemento'/> Me gusta</td>";
                                if(isset($_POST['enviar']) && (isset($_POST['modulos'])) && in_array("$elemento",$_POST['modulos'])){
                                    echo 'checked="checked"';
                                }
                                echo "</tr>";
                                $contF++;
                            }
                            $cont++;
                        }  
                    } 
                ?>
            </table>
            <p><input type="submit" value="ENVIAR VALORACIONES" name="enviar"></p>
        </form>
    <?php
        }
    ?>
    </body>
</html>