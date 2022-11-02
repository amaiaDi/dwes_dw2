<!DOCTYPE html>

<html>
<body>

<?php
if(!isset($_POST["cantidad"])){
    $_POST["cantidad"]=0;
}

?>
    <?php print "<form action='conversion.php' method='post'>"?>
        <table>
            <tr>
                <td>Cantidad:</td>
                <td><?php  
            
                    print "<input type='text' id='cantidad' name='cantidad' value='$_POST[cantidad]'>"?></td>
                <td><input type="radio" value="1" name="conver" id="ED">euro a dolar<br>
                    <input type="radio" value="2" name="conver" id="DE">dolar a euro<br></td>
            </tr>
            <tr>
                <td><?php 
                if(isset($_POST["conver"])){
                if($_POST["cantidad"]==""){
                    print "ERROR : VACIO";
                }
                else{
                    $handle = fopen("archivo/conversion.txt", "r");
                    $linea = fgets($handle);
                    $edV = strchr($linea,";",1);
                    $deV = substr(strchr($linea,";"),1);
                    
                    if(is_numeric($_POST["cantidad"])){
                        if($_POST["conver"]=="1"){
                            print $_POST["cantidad"]*$edV."$";
                        }
                        if($_POST["conver"]=="2"){
                            print $_POST["cantidad"]*$deV."€";
                        }
                    }
                    else{
                        print "ERROR : No Numerico";
                    }
                }
            }
            
                ?></td>
            </tr>
            <tr>
                <td><button type="submit" name="convertir" value="a" id="convertir">CONVERTIR</td>
            </tr>
        </table>
    </form>
</body>
</html>