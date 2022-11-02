<?php
    function mostrarCharla(){
        $mensaje="";
        $f= fopen('ficheros/charla.txt', 'r' );
        if(!$f){
             echo 'EL ARCHIVO NO EXISTE';
        }else{
            while (!feof($f)){
                 $palabra = fgets ($f); 
                 $nombre=substr($palabra,0, strpos($palabra,":"));
                 $m=contieneInsultos(contieneCarita(substr($palabra,strpos($palabra,":"))));
                 $mensaje.= "<strong>$nombre</strong>".$m."<br>";   
            }
        fclose ($f) ;
        }
        return $mensaje;
    }

    function contieneCarita($palabra){
         $nuevaPalabra="";
        for ($i=0; $i < strlen($palabra)-1 ; $i++) { 

            if($palabra[$i]==":"){
                if($palabra[$i+1]==")"){
                 $nuevaPalabra.="😋"; 
                 $i++;
                }else if($palabra[$i+1]=="("){
                    $nuevaPalabra.="🙁"; 
                    $i++;
                }else{
                    $nuevaPalabra.=$palabra[$i];
                }
            }else{
                $nuevaPalabra.=$palabra[$i];
            }
        }
        return $nuevaPalabra.$palabra[strlen($palabra)-1];
    }

    function contieneInsultos($palabra){
        $insultos=leerInsultos();
        foreach($insultos as $insulto){
            if (strstr($palabra, $insulto)) {
                return ": *****";
            }
        }
        return $palabra;
    }

    function leerInsultos(){
        $insultos = array();
        $f= fopen('ficheros/insultos.txt', 'r' );
        if(!$f){
            echo 'EL ARCHIVO NO EXISTE';
        }else{
            while (!feof($f)){
                $usu = fgets ($f);
                array_push($insultos, $usu);  
            }
        fclose ($f) ;
        }
        return $insultos;
    }    
?>
<script type="text/javascript">
            window.onload = function() {
            window.scrollTo(0, document.body.scrollHeight);
                }       
        </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <p><?php echo mostrarCharla(); ?></p>
</body>
</html>