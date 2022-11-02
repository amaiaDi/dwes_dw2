<?php
session_start();

?>
<!DOCTYPE html>
<html>
<body>
<?php if($_GET["type"]!=1): ?>
<?php

$lastr=array("");
print "<form action='eval_imag.php?type=1' method='post'>";
for($i=1;$i<=$_SESSION["archivo"];$i++){
    $DIRIMG = opendir("imagenes/");
    $cont=1;
    do{
        $d=0;
        $r=rand(3,$_SESSION['cont']+1);
        foreach($lastr as $c){
            if($c==$r){
                $d=1;
            }
        }
    } while($d==1);
    array_push($lastr,$r);
    while(false !== ($listar_d = readdir($DIRIMG))) {
        if ($listar_d[0] != "." && $listar_d[0] != ".." && $cont==$r){
                print "<img src='imagenes/$listar_d' width='100' height='100' >
                <input type='checkbox' id='likes$cont' name='likes$cont' value='$cont'> Me gusta";
        }
        $cont++;
       
    }
    
    print "<br>";
    closedir($DIRIMG);
    


}
    $_SESSION["imaN"]=$lastr;
    print '<button type="submit" name="enviar" value="a" id="enviar">ENVIAR';
    print "</form>";
    $a=1;
    

    ?>
<?php else:?>
    <?php 
         $anadir = fopen("fichero/fichero.txt", "a");
         fwrite($anadir, $_SERVER['REMOTE_ADDR']);
            fclose($anadir);
    ?>
    <p>Gracias por tu envio</p>
<?php endif;?>


    
</body>
</html>