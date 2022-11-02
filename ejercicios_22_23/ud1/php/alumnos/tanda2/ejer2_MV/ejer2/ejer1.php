<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
        ul {
            list-style: none;
            
        }
    </style>
    <body>
        <?php
            $nombre="";
            $arrmodulos = array();
            
            /*Se comprueba si se ha clicado el boton Enviar y, en caso de que 
             * el campo nombre tenga un valor, se guarda en una variable  
             */
            if((isset($_POST['cifrSust']) || isset($_POST['cifrCes'])) && !empty($_POST['nombre'])){
                $nombre = $_POST['nombre'];
            }

        ?>
        <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
                <tr>
                    <td>Texto a cifrar</td>
                    <td><input type="text" name="nombre" value="<?php echo $nombre; ?>" /></td>
                    
                    <?php
                        /*Si se ha pulsado el boton Enviar y el campo nombre no tiene
                        * ningún valor, se muestra un mensaje al lado de la caja de texto
                        */ 
                        if ((isset($_POST['cifrSust']) || isset($_POST['cifrCes'])) && empty($_POST['nombre'])){
                            echo "<td> *Debe introducir un texto</td>";
                        }
                    ?>
                    
                </tr>
                
                <tr>
                    <td>Desplazamiento</td>
                    <td>
                        <ul>
                            <li>
                                <input type="radio" name="modulos[]" value="m3"
                                <?php
                                    /*Si se ha pulsado el boton Enviar y el modulo ha sido 
                                    * seleccionado, se marca.
                                    */
                                    if(isset($_POST['cifrCes']) && (isset($_POST['modulos'])) && in_array("m3",$_POST['modulos'])){
                                        $numCesar=3;
                                    }
                                ?>
                                />
                                
                                3
                            </li>
                                 
                            <li>
                                <input type="radio" name="modulos[]" value="m5"
                                <?php
                                    /*Si se ha pulsado el boton Enviar y el modulo ha sido 
                                    * seleccionado, se marca.
                                    */
                                    if(isset($_POST['cifrCes']) && (isset($_POST['modulos'])) && in_array("m5",$_POST['modulos'])){
                                        $numCesar=5;
                                    }
                                ?>
                                />
                                5
                            </li>        
                             
                            <li>
                                <input type="radio" name="modulos[]" value="m10"
                                <?php
                                    /*Si se ha pulsado el boton Enviar y el modulo ha sido 
                                    * seleccionado, se marca el checkbox como clicado.
                                    */
                                    if(isset($_POST['cifrCes']) && (isset($_POST['modulos'])) && in_array("m10",$_POST['modulos'])){
                                        $numCesar=10;
                                    }
                                ?>
                                />
                                10 
                            </li>
                            
                        </ul>
                    </td>
                    <td><input type="submit" value="CIFRADO CESAR" name="cifrCes"/></td>
                    <?php
                        /*Si se ha pulsado el boton Enviar y no se ha seleccionado ningún
                        * modulo, se muestra un mensaje de encima
                        */
                        if (isset($_POST['cifrCes']) && (!isset($_POST['modulos']))){
                            echo "<td>*Debes indicar un desplazamiento</td>";
                        }
                    ?>
                </tr>  
                <tr>
                    <td>Fichero de clave</td>
                    <td>
                        <select name="ficheros">
                            <option value="fichero_clave1.txt">fichero_clave1.txt</option>
                        </select> 
                    </td>
                    <td><input type="submit" value="CIFRADO POR SUSTITUCION" name="cifrSust"/></td>
                </tr>
            </table>  
        </form>
    <?php
        if (!empty($_POST['nombre']))
        {
            $nombre = $_POST['nombre'];
            $cifrado="";
            if (isset ($_POST['modulos']) && isset($_POST['cifrCes'])){
                for ($i=0; $i < strlen($nombre); $i++) { 
                    $letra=substr($nombre,$i,1);
                    for ($i2=0; $i2 < $numCesar ; $i2++) { 
                        ++$letra;
                    }
                    $cifrado="$cifrado$letra";
                    
                }
                echo "<p><b>Texto cifrado: $cifrado</b></p>";
            }
            else{
                if (isset($_POST['cifrSust'])) {
                    $nomFich=$_REQUEST['ficheros'];
                    $handle = fopen("$nomFich", "r");
                    $linea = fgets($handle);
                    $posicion="a";
                    $array=array();
                    for ($i=0; $i < strlen($linea); $i++) { 
                        $letra=substr($linea,$i,1);
                        $array[$posicion]=$letra;
                        ++$posicion;
                    }
                    fclose($handle);
                    for ($i=0; $i < strlen($nombre); $i++) { 
                        $letra=substr($nombre,$i,1);
                        $cifrado="$cifrado$array[$letra]";
                    }
                    echo "<p><b>Texto cifrado: $cifrado</b></p>";
                }
            }
            
        }
    ?>
    </body>
</html>