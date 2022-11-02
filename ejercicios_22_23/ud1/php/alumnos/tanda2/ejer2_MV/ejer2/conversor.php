<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    span{
        color:red;
    }
</style>
<body>
    <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table><th><td>Cantidad:</td>  
            <?php 
                if(isset($_SESSION['num'])) {
                    $num= $_SESSION['num'];
                    $sel= $_SESSION['sel'];
                    echo "<td><input type='text' name='cant' value='$num'></td>";
                }else {
                    echo "<td><input type='text' name='cant'></td>";
                }
            ?>
            <?php 
                if (isset($_POST['convertir']) && empty($_POST['cant'])){
                    echo "<td><span>¡VACIO!</span></td>";
                }
                else {
                    if (isset($_POST['convertir']) && !is_numeric($_POST['cant'])) {
                        echo "<td><span>¡NO NUMERICO!</span></td>";
                    }
                }
                
            ?> 
            <label class="radio-inline">
            <td><input type="radio" name="conv" value="euro" checked>Euro a dolar</label><br>
            <label class="radio-inline">
            <input type="radio" name="conv" value="dolar">Dolar a euro</label></td>
        </th></table>
          
        <?php
            if (isset($_SESSION['num'])){
                $fp = fopen("factor.txt", "r");
                while(!feof($fp)) {
                    $linea = fgets($fp);
                    $euro=strstr($linea,";",true);
                    $dolar=strstr($linea,";");
                    $dolar=substr($dolar,1);
                    $dolar=trim($dolar);
                    if (($euro!="" || $dolar!="")) {
                        if ($sel=="euro") {
                            echo "<p>".$euro*$num."$</p>";
                        }
                        else {
                            echo "<p>".$dolar*$num."€</p>";
                        }
                    }
                }
                fclose($fp);
            }
        ?>
        <input type="submit" value="CONVERTIR" name="convertir">
        <?php
            if (isset($_POST['convertir']) && !empty($_POST['cant']) && is_numeric($_POST['cant'])){
                $num=$_REQUEST['cant'];
                $_SESSION['num'] = $num;
                $sel=$_REQUEST['conv'];
                $_SESSION['sel'] = $sel;
                header("Location: conversor.php");
            }
            else {
                unset($_SESSION['num']);
                unset($_SESSION['sel']);
            }
        ?>
    </form>
    
    
</body>
</html>