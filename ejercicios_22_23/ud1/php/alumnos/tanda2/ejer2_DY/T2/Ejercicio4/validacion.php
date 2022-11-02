<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
       $nomUsu = $_POST['nombreUsuario'];
       $contr = $_POST['contraseña'];
       $arrGeneral = array();

       arrayGeneral();


       if(array_key_exists($nomUsu, $arrGeneral)){
            
            if(empty($contr) || trim($arrGeneral[$nomUsu]) != $contr){
                $error = "Contraseña erronea para ".$nomUsu;
                header("location: login.php?mensajeError=$error");
            }else{
                header("location: charla.php?nom=$nomUsu");
            }
       }else{
            header('Location: alta.php');
       }

       function arrayGeneral(){
            global $arrGeneral;
            $fp = fopen("usuarios.txt", "r");
            while (!feof($fp)){
                $linea = fgets($fp);
                $nombre = substr($linea, 0, stripos($linea,';'));
                $contr = substr($linea, stripos($linea,';')+1);
                $arrGeneral[$nombre] = $contr;

            }
            fclose($fp);
       }
    ?>
</html>