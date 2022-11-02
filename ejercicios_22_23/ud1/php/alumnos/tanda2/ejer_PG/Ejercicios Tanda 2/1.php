<!DOCTYPE html>
<html>
<body>

<?php

$text=str_split($_POST["text"]);
$textEnc="";

//Cifrado Cesar
if($_POST["cifrar"]=="a"){
foreach($text as $letra){
    for($i=0;$i<$_POST["desplazamiento"];$i++){
        ++$letra;
    }
    $textEnc=$textEnc.$letra;
}

print "Cifrado cesar: ".$textEnc;
}

//Cifrado por sustitucion
if($_POST["cifrar"]=="b"){
    $handle = fopen("ficheros/encrip.txt", "r");
        $linea = fgets($handle);
        foreach($text as $letra){
            $numL=ord($letra)-97;
            $comp = substr($linea,$numL,1);
            $textEnc=$textEnc.$comp;
            }
            
         fclose($handle);   
        
        print "Cifrado por sustistución: ".$textEnc;
 }

?>

<form action="1.php" method="post">
<table>
    <tr>
        <td>Texto cifrar</td>
        <td><input type="text" name="text" id="text"/></td>
    </tr>
    <tr>
        <td>Desplazamiento</td>
        <td>
                3 <input type="radio" value="3" name="desplazamiento" id="desplaza3"><br>
                5 <input type="radio" value="5 "name="desplazamiento" id="desplaza5"> <br>
                10  <input type="radio" value="10" value="desplazamiento" name="desplazamiento" id="desplaza10">
        </td>
        <td><button type="submit" name="cifrar" value="a" id="cifradoCe">Cifrado Cesar</td>
    </tr>
    <tr>
        <td>Fichero Clave</td>
        <td><select><option value="ficheros/encrip.txt">cifrar</option></select></td>
        <td><button type="submit" name="cifrar" value="b" id="cifradoSus">Cifrado Por Sustitucion</button></td>
    </tr>
</table>
 	

  



</form>

</body>
</html>