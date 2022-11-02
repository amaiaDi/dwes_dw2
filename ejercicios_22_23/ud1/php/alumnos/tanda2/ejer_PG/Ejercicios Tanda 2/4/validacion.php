<!DOCTYPE html>
<?php
session_start();
?>
<html>
<body>

<?php
$create=1;
$handle = fopen("archivos/usuarios.txt", "r");

while(!feof($handle)){
    $linea = fgets($handle);
    $nom = trim(strchr($linea,";",1));
    $contra = trim(substr(strchr($linea,";"),1));
    if($_SESSION["userN"]==$nom){
        $create=0;
        if($_SESSION["userP"]==$contra){
            header("location: charla.php");
        }
        else{
            header("location: login.php?error=1");
        }
    }
}
fclose($handle);
if($create==1){
    header("location: alta.php?$_SESSION[userN]&$_SESSION[userP]&$nom&$contra");
}
?>

</body>
</html>