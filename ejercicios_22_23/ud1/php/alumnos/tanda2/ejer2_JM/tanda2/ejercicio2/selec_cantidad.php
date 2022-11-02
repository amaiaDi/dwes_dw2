<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar imágen</title>
</head>
<body>
<?php

function esImagen($nombre_archivo){
    $arr_extensiones = ["jpg","jpeg","png","webp","gif"];
    $img_extension = explode(".",$nombre_archivo);
    foreach($arr_extensiones as $extension){
        if($img_extension[1] == $extension){
            return true;
        }
    }
    return false;
}

function cuantasImag($carpeta_imagenes){
    $arr_imagenes = scandir($carpeta_imagenes);
    $cont = 0;
    foreach($arr_imagenes as $imagen){
        if(esImagen($imagen)){
            $cont++;
        }
    }
    return $cont;
}

echo " <form  action='eval_imag.php' method='post'>
<label for='combo_img'>¿Cuántas imágenes deseas ver?</label>
<select name='combo_img'>";
for ($i = 2; $i<=cuantasImag('DIRIMG');$i++){
    echo "<option>$i</option>";
}    
echo "</select><br/><br/>";
echo "<button name='sel_cant' type='submit'>VER IMÁGENES </button></form>";


?>
</body>
</html>




