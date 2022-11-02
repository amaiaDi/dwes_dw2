<?php
    function cifradoCesar($cadena, $despl){
        $diff = ord('Z') - ord('A')+1;
        $nuevaCadena="";
        for ($i=0; $i<strlen($cadena);$i++){
            $char = ord($cadena[$i]) + $despl;
            if ($char > ord('Z')){
                $char -= $diff;
            }
            $nuevaCadena .= chr($char); 
        }
        return $nuevaCadena;
    }

    function cifradoFichero($cadena, $nomFich){
        $handle = fopen("./utils/".$nomFich, "r");
        while (!feof($handle)) {
            $linea = fgets ($handle);
        }
        fclose($handle);
        $nuevaCadena ="";
        for ($i=0; $i<strlen($cadena);$i++){
            $char = $cadena[$i];
            $nuevaCadena.= $linea[ord($char)- ord('A')];
        }
        return $nuevaCadena;
    }

    define('N_DESPL', [3, 5, 10]);
    $GLOBALS['radioSel'] = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrado</title>
</head>
<style>
    .radios{
        display:block;
    }
</style>
<body>

    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <tr>
                <td>
                    <label for="txtTextoaCifrar">Texto a cifrar</label>
                </td>
                <td>
                    <?php
                        if (isset($_POST['txtTextoaCifrar'])){
                            echo "<input type='text' name='txtTextoaCifrar' value=".$_POST['txtTextoaCifrar']."></input>";
                        }else{
                            echo "<input type='text' name='txtTextoaCifrar'></input>";
                        }
                    ?>  
                </td>
                <td>
                    <?php
                        if (isset($_POST['cesar']) || isset($_POST['sust']) && $_POST['txtTextoaCifrar'] == ""){
                            echo "<p>* Debes introducir un texto</p>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="despl">Desplazamiento</label>
                </td>
                <td>
                    <?php
                        for ($i=0; $i<count(N_DESPL);$i++){
                            $num = N_DESPL[$i];
                            if (isset($_POST['despl']) && $num == $_POST['despl']){
                                echo '<label for="'.$num.'" class="radios">
                                    <input type="radio" name="despl" id="'.$num.'" value="'.$num.'" checked>'
                                    .$num.'</label>';
                                $GLOBALS['radioSel'] = true;
                            }
                            else
                                echo '<label for="'.$num.'" class="radios">
                                    <input type="radio" name="despl" id="'.$num.'" value="'.$num.'">'
                                    .$num.'</label>';
                        }
                    ?>
                </td>
                <td>
                    <input type="submit" name="cesar" value="CIFRADO CESAR">
                </td>
                <td>
                    <?php
                        if (isset($_POST['cesar']) && !$GLOBALS['radioSel']){
                            echo '<p>* Debes indicar un desplazamiento</p>';
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ficheroClave">Fichero de clave</label>
                </td>
                <td>
                    <?php
                        $n = 1;
                        $txtHtml ="<select name='ficheroClave'>";
                        $directories=scandir('./');
                        foreach($directories as $dir){
                            if(is_dir($dir) && $dir == "utils"){
                                $urlDir='./'.$dir;
                                $files=scandir($urlDir);
                                foreach($files as $f){
                                    $urlFile=$urlDir.'/'.$f;
                                    if(is_file($urlFile) and $f!='index.php' and strpos($f,'.txt')!=false){
                                        $txtHtml .= "<option>".$f."</option>";
                                        $n++;
                                    }
                                }
                            }
                        }
                        echo $txtHtml."</select>";
                    ?>
                </td>
                <td>
                    <input type="submit" name="sust" value="CIFRADO POR SUSTITUCION">
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        if (isset($_POST['cesar'])){
                            $cadena = $_POST['txtTextoaCifrar'];
                            if ($cadena != "" && isset( $_POST['despl'])){
                                $despl = $_POST['despl'];
                                $nuevaCadena = cifradoCesar(strtoupper($cadena), $despl);
                                echo '<strong>Texto Cifrado: '.$nuevaCadena.'</strong>';
                            }
                            
                        }else if (isset ($_POST['sust'])){
                            $cadena = $_POST['txtTextoaCifrar'];
                            if ($cadena != ""){
                                $nomFich = $_POST['ficheroClave'];
                                $nuevaCadena = cifradoFichero(strtoupper($cadena), $nomFich);
                                echo '<strong>Texto Cifrado: '.$nuevaCadena.'</strong>';
                            }
                        }
                    ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>