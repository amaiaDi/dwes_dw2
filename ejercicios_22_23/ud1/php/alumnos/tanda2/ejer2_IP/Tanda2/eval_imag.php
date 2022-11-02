<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
            function rutas_imag(){
            $arrRutas = array();
            $dir = opendir("DIRIMG");
            while ($elemento = readdir($dir)){
                // Tratamos los elementos . y .. que tienen todas las carpetas
                if( $elemento != "." && $elemento != ".."){
                    //Asignamos el elemento de la carpeta a la variable $ruta y la añadimos al array $arrayRutas
                    $ruta = "DIRIMG/".$elemento;
                    array_push($arrRutas, $ruta);
                }
            }
            return $arrRutas;
        }

        
        function crearTabla($cant){
            //Guardamos en una variable el array de imágenes que nos devuelve el metodo rutas_imag()
            $RI=rutas_imag();
            $imagenes=[];    
            //Declaramos la variable $tabla con un valor tabla    
            $tabla ="<table>";
                //Mientras el array de imágenes no tenga la misma cantidad que las solicitadas por el método,
                while(sizeof($imagenes)<$cant){    
                    //Buscamos una imágen aleatoria        
                    $random=rand(0, sizeof($RI)-1);
                    //Si la imagen no existe en el array, creamos una fila con la imágen y una caja de check, además de añadir dicha imágen al array
                    if (!in_array($RI[$random], $imagenes)){
                        $tabla.="<tr>";
                        $tabla.="<td><img src='$RI[$random]' width='100px'></td>";
                        $tabla.="<td><input type='checkbox' name='arrFotos[]' value='$RI[$random]'>Me gusta</td>";
                        array_push($imagenes, $RI[$random]);
                        $tabla.="</tr>";
                    }
                }    
            $tabla.="</table>";
            return $tabla;
        }
        
    ?>
    <body>                          
        <?php 
            $n;
            //Si selec_cantidad.php cantImagenes no está vacio y el botón clickado no es el de este .php, se le da valor a la $n y se realiza todo lo siguiente
            if(!empty($_POST["cantImagenes"]) && !isset($_POST["enviarValoraciones"])){
                $n = $_POST['cantImagenes']; 
        ?>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php echo crearTabla($n);?>
            <input type="submit" value="ENVIAR VALORACIONES" name="enviarValoraciones"/>
            <input type="hidden" value="ENVIO FINAL" name="infoFinal"/>
        </form>
        <?php
        }else{
            //Si no le gusta ninguna foto
            if(empty($_POST['arrFotos'])){
                echo "Siento mucho que tengas mal gusto <a href='selec_cantidad.php'>VOLVER</a><br>";
                echo "<img src='imagenes/joselu.jpg' width='600px'>";
            }else{
                echo "Muchas gracias por su opinión! <a href='selec_cantidad.php'>VOLVER</a><br>";
                $fotosElegidas=$_POST["arrFotos"];
                file_put_contents("fotosEj2.txt", "IpDesconocida: ",FILE_APPEND);
                for($i=0;$i<sizeof($fotosElegidas);$i++){
                    file_put_contents("fotosEj2.txt", substr($fotosElegidas[$i], strpos($fotosElegidas[$i], "/")+1)." ", FILE_APPEND);
                }
                file_put_contents("fotosEj2.txt", "\r\n", FILE_APPEND);

                //IP no funciona
                //echo $_SERVER['REMOTE_ADDR'];
                //$ip_address = gethostbyname("localhost");  
                //echo "IP Address of Google is - ".$ip_address;               
            }
        }
        ?>
    </body>
</html>