<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
        <?php
            $ruta = "../ficheros_clave";
            $array = array(3,5,10);
            $errorDesplazamiento = "";
            $errorTexto = "";
            //en caso de darle al boton cesar validar lo siguiente
            if(isset($_POST["cifradoCesar"])){
                if(empty($_POST["desplacamiento"]))
                    $errorDesplazamiento  ="*debes indicar un desplazamiento";
            }
            if(empty($_POST["cifrado"]))
                $errorTexto  ="*debes introducir un texto";
        ?>
    <main>
        <form action="01.php" method="post">
            <table>
                <tr>
                    <td><label for="cifrado">Texto a cifrar</label></td>
                    <td>
                        <input type="text" name="cifrado" id="cifrado" 
                            <?php 
                                //al recargar la pagina pone el texto a cifra en mayusculas
                                if(isset($_POST["cifrado"])){
                                    $para_Cifrar = strtoupper($_POST["cifrado"]);
                                    $_POST["cifrado"] = $para_Cifrar;
                                    echo "value=".$para_Cifrar;
                                }
                            ?>
                        >
                    </td>
                    <td>
                        <?php
                            //en caso de que haya dejado vacio el texto a cifrar
                            if(isset($errorTexto) && !empty($errorTexto)){
                                echo "<p>".$errorTexto."</p>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td rowspan="3">desplacamiento</td>
                    <td>
                        <input type="radio" name="desplacamiento" id="num3" value="<?php echo $array[0] ?>"
                            <?php
                                //para mantener el valor de checked en el boton
                                if(isset($_POST["desplacamiento"]) && in_array($array[0],$_POST))
                                    echo "checked";
                            ?> 
                         />
                        <label for="num3"><?php echo $array[0] ?></label>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="desplacamiento" id="num5" value="<?php echo $array[1] ?>"
                            <?php 
                                if(isset($_POST["desplacamiento"]) && in_array($array[1],$_POST))
                                    echo "checked";
                            ?>
                        />
                        <label for="num5"><?php echo $array[1] ?></label>
                    </td>
                    <td>
                        <input type="submit" name="cifradoCesar" id="cifradoCesar" value="CIFRADO CESAR">
                        <?php
                            if(isset($errorDesplazamiento) && !empty($errorDesplazamiento)){
                                echo $errorDesplazamiento;
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="radio" name="desplacamiento" id="num10" value="<?php echo $array[2] ?>"
                            <?php 
                                if(isset($_POST["desplacamiento"]) && in_array($array[2],$_POST))
                                    echo "checked";
                            ?>
                        />
                        <label for="num10"><?php echo $array[2] ?></label>
                    </td>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="fichero">Fichero de clave</label>
                        <select name="fichero" id="fichero">
                            <?php
                               //conseguir los ficheros del documento
                                $gestor = opendir($ruta); 
                                while (($archivo = readdir($gestor)) !== false)  {
                                    if ($archivo != "." && $archivo != "..") {
                                        echo "<option value='".$archivo."'>" . $archivo . "</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                    </td>
                    <td><input type="submit" name="cifradoSustitucion" value="CIFRADO POR SUSTITUCION"></td>
                </tr>
            </table> 
        </form>
        <span>
            <?php
                $cifrado = "";
                //en caso de que es cifrado Cesar
                if( isset($_POST["cifradoCesar"]) && isset($_POST["desplacamiento"]) && isset($_POST["cifrado"])){
                    $string = $_POST["cifrado"];
                    $desplazamiento = $_POST["desplacamiento"];
                    for ($i=0; $i < strlen($string); $i++) { 
                        $char = substr($string,$i,1);
                        for($j = 0; $j < $desplazamiento;$j++){
                            if($char == 'z'){
                                $char = 'a';
                            }else{
                                $char = ++$char;
                            }
                        }
                        $cifrado = $cifrado . $char;
                    }
                    echo "<p><b>Texto Cifrado:". $cifrado."</b></p>";
                }
                //en caso de que es cifrado de sustitucion
                if(isset($_POST["cifradoSustitucion"]) && isset($_POST["cifrado"])){
                    $string = $_POST["cifrado"];
                    $select_file = $_POST["fichero"];
                    $handle = fopen("./".$ruta."/".$select_file,"r");
                    $linea = fgets($handle);
                    fclose($handle);
                    for ($i=0; $i < strlen($string); $i++) { 
                        $letra = $string[$i];
                        $char_position = ord($letra) -65;
                        for ($j=0; $j < strlen($linea); $j++) {
                            if($j == $char_position){
                                $cifrado = $cifrado . $linea[$j];
                            }
                        }
                    }
                    echo "<p><b>Texto Cifrado:". $cifrado."</b></p>";
                }
            ?>
        </span>
    </main>
</body>
</html>