<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo"<table>";
    $arrayImg=array("https://cdn.shopify.com/s/files/1/0229/0839/files/bancos_de_imagenes_gratis.jpg?v=1630420628&width=1024",
        "https://www.tooltyp.com/wp-content/uploads/2014/10/1900x920-8-beneficios-de-usar-imagenes-en-nuestros-sitios-web.jpg",
        "https://cdn.shopify.com/s/files/1/0229/0839/files/bancos_de_imagenes_gratis.jpg?v=1630420628&width=1024",
        "https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg",
        "https://images.pexels.com/photos/209807/pexels-photo-209807.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
    );
    function verImagenes($array){
        $arraySinRepes=array_unique($array);
        $cont=1;
       
        foreach ($arraySinRepes as $valor) { 
            if ($cont==1) {
                echo"<tr>";
            }
            echo"<td><a href='$valor'><img src='$valor' width='300' height='230' alt='img'></a></td>";
            if ($cont==3) {
                $cont=1;
                echo"</tr>";
            }else {
                $cont++;
            }
            
        }
    }
    verImagenes($arrayImg);
    echo"</table>";
    ?>
</body>
</html>