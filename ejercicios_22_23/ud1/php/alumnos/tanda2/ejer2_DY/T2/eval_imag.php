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
                    $ruta = "C:/wamp/www/dwes/U1/T2/DIRIMG/".$elemento;
                    array_push($arrRutas, $ruta);
                }
            }
            /*for ($i = 0; $i < sizeof($arrRutas); $i++) { 
                echo $arrRutas[$i];
            }*/
            return $arrRutas;
        }

        function rutas_Relativas(){
            $arrRutas = array();
            $dir = opendir("DIRIMG");
            while ($elemento = readdir($dir)){
                // Tratamos los elementos . y .. que tienen todas las carpetas
                if( $elemento != "." && $elemento != ".."){
                    $ruta = "DIRIMG/".$elemento;
                    array_push($arrRutas, $ruta);
                }
            }
            return $arrRutas;
        }

        //$modulos2 = array("PR" => "Programación", "BD" => "Bases de datos", ......., "DWES" => "Desarrollo servidor");
        function crearTabla($dimension){
            $arrAle = array();
            $arrCheck = array();
            $tabla = "<table>";
                for ($i = 0; $i < $dimension; $i++) {
                    //hacemos numero aleatorio para mostrar dos imagenes aleatorias
                    $numAle = rand(0, sizeof(rutas_imag())-1);
                        //controlamos que no salga un numero aleatorio repetido
                        while(in_array($numAle, $arrAle)){
                            $numAle = rand(0, sizeof(rutas_imag())-1);
                        }
                    array_push($arrAle, $numAle);
                    //sacar imagen
                    $img = rutas_Relativas()[$numAle];
                    $nomImagen = substr($img, stripos($img,'/')+1);
                    $img = "<img src='$img' width = '200'>";
                    //añadimos checkbox al array de checkbox
                    $check = "<input type='checkbox' name='valoracion[]' value='$nomImagen'>Me gusta</input>";
                    array_push($arrCheck, $check);
                    //añadir el checkbox y la imagen a la tabla
                    $tabla = $tabla."<tr> <td>$img</td> <td>$arrCheck[$i]</td>  </tr>";
                }
            $tabla = $tabla."</table>";
            return $tabla;
        }
        
        


    ?>
    <body>                 
                    <?php 
                    if(!empty($_POST['cantImagenes']) && !isset($_POST['enviarValoracion'])){
                        $n = $_POST['cantImagenes'];
                    
                    ?>          
                    <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <?php echo crearTabla($n)?>
                        <input type="submit" name="enviarValoracion" value="ENVIAR VALORACIONES"/>
                    </form>
                    <?php 
                        }else{
                            if(empty($_POST['valoracion'])){
                                echo "sentimos que no te haya gustado ninguna";
                            }else{
                                echo "Gracias por tu envio <br>";
                                echo "<a href='selec_cantidad'>Volver a la página inicial</a>";

                                //Contenido del fichero
                                $ip = $_SERVER['REMOTE_ADDR'].": ";
                                file_put_contents("ejercicio2.txt", $ip);
                                $arr = $_POST['valoracion'];
                                for ($i=0; $i < sizeof($arr); $i++) { 
                                    file_put_contents("ejercicio2.txt", $arr[$i]."    ", FILE_APPEND);
                                }

                            }
                        }
                    ?>  
    </body>
</html>