<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluador de imágenes</title>
</head>
<body>
    
</body>
</html>


<?php

function rutas_imag($carpeta_imagenes){
    $arr_img = scandir(($carpeta_imagenes));
    $arr_img = array_slice($arr_img,2);
    return $arr_img;
}

if(isset($_POST['sel_cant'])){
    $numero_imagenes = $_POST['combo_img'];
    $arr_rutas_img = rutas_imag('DIRIMG');
    $arr_claves = array_rand($arr_rutas_img, $numero_imagenes);
    $arr_img_mostrar = [];
    foreach($arr_claves as $clave){
        array_push($arr_img_mostrar, $arr_rutas_img[$clave]);
    }
?>
<form action="<?php $_SERVER["PHP_SELF"]; ?>"  method='post'>
    <table>
        <?php
            for($i=0; $i<$numero_imagenes; $i++){
                echo " 
                <tr>
                <td><img src='DIRIMG/$arr_img_mostrar[$i]' width='300'></td>
                <td><input type='checkbox' value='$arr_img_mostrar[$i]' name='foto_marcada[]'> Me gusta</td>
                </tr>
                ";
            }
            
            
            echo " </table><br/>
            <button type='submit' name='enviar'>ENVIAR VALORACIONES</button>";
            


echo "</form>";

}
elseif (isset($_POST['enviar'])){
   
    if(empty($_POST['foto_marcada'])){
        echo "Sentimos que no le haya gustado ninguna";
        echo "<br><br><a href='selec_cantidad.php'>Volver a la página principal</a>";
    }
    else{
        echo "Gracias por valorar nuestras imágenes";
        echo "<br><br><a href='selec_cantidad.php'>Volver a la página principal</a>";
        $ip = gethostbyname(gethostname());
        $archivo = fopen("likes_fotos.txt","a");
        $foto =  $_POST['foto_marcada'] ;
        fwrite($archivo, "$ip:");
        foreach($foto as $f){
            fwrite($archivo, "$f  ");
        }
        fwrite($archivo,  PHP_EOL);
        fclose($archivo);
    }   

}
    ?>


