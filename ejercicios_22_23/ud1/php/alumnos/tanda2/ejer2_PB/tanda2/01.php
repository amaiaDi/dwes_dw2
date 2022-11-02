<?php

    $error_cesar = '';
    $error_desplazamiento = '';
    $error_sustitucion = '';
    $texto = '';
    $resultado = 'Texto cifrado: ';

    if (isset($_POST['cesar'])) {
        $texto = strtoupper($_POST['texto']);

        if (empty($texto)) {
            $error_cesar = '*Debes introducir un texto';
        } else {
            if (empty($_POST['desplazamiento'])) {
                $error_desplazamiento = '*Debes indicar un desplazamiento';
            } else {
                $numero = intval($_POST['desplazamiento']);
                $palabra = str_split($texto);
                for ($i=0; $i < count($palabra); $i++) { 
                    $resultado .= chr(ord($palabra[$i]) + $numero);
                }
            }
        }
    }

    if (isset($_POST['sustitucion'])) {
        $texto = strtoupper($_POST['texto']);
        $num_fichero = $_POST['ficheros'];
        $letras = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

        if (empty($texto)) {
            $error_sustitucion = '*Debes introducir un texto';
        } else {
            $array_texto = str_split($texto);
            $array_fichero = array();
            for ($i=0; $i < count($array_texto); $i++) { 
                for ($j=0; $j < count($letras); $j++) { 
                    if (strcmp($array_texto[$i], $letras[$j]) === 0) {
                        $handle = fopen("ficheros/fichero_clave" . $num_fichero . ".txt", "r");
                        while (!feof($handle)) {
                            $linea = fgets($handle);
                            $array_fichero = str_split($linea);
                        }
                        fclose($handle);
                        $resultado .= $array_fichero[$j];
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <td>
                    <label for="texto">Texto a cifrar: </label><input type="text" name="texto" id="texto" value="<?php
                        if (isset($_POST['cesar']) && empty($_POST['desplazamiento'])) {
                            echo $_POST['texto'];
                        }

                        if (isset($_POST['cesar']) && !empty($_POST['texto']) && !empty($_POST['desplazamiento'])) {
                            echo $texto;
                        }
                    ?>">
                </td>
                <td>
                    <?php
                        if (isset($_POST['cesar']) && !empty($error_cesar)) {
                            echo '<p>' . $error_cesar . '</p>';
                        }

                        if (isset($_POST['sustitucion'])) {
                            echo '<p>' . $error_sustitucion . '</p>';
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td style="display: flex; align-items: center">
                    <label for="desplazamiento">Desplazamiento</label>
                    <ul style="list-style-type: none;">
                        <li><input type="radio" name="desplazamiento" value="3" <?php
                                                                                    if (isset($_POST['cesar']) && !empty($_POST['desplazamiento']) && $_POST['desplazamiento']=="3") {
                                                                                        echo 'checked="checked"';
                                                                                    }
                                                                                ?>>3</li>
                        <li><input type="radio" name="desplazamiento" value="5" <?php
                                                                                    if (isset($_POST['cesar']) && !empty($_POST['desplazamiento']) && $_POST['desplazamiento']=="5") {
                                                                                        echo 'checked="checked"';
                                                                                    }
                                                                                ?>>5</li>
                        <li><input type="radio" name="desplazamiento" value="10" <?php
                                                                                    if (isset($_POST['cesar']) && !empty($_POST['desplazamiento']) && $_POST['desplazamiento']=="10") {
                                                                                        echo 'checked="checked"';
                                                                                    }
                                                                                ?>>10</li>
                    </ul>
                </td>
                <td>
                    <button type="submit" name="cesar">CIFRADO CESAR</button>
                </td>
                <td>
                    <?php
                        if (isset($_POST['cesar']) && empty($error_cesar) && !empty($error_desplazamiento)) {
                            echo '<p>' . $error_desplazamiento . '</p>';
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="fichero">Fichero de clave</label>
                    <select name="ficheros" id="ficheros">
                        <option value="1">fichero_clave1.txt</option>
                        <option value="2">fichero_clave2.txt</option>
                        <option value="3">fichero_clave3.txt</option>
                    </select>
                </td>
                <td>
                    <button type="submit" name="sustitucion">CIFRADO POR SUSTITUCIÓN</button>
                </td>
            </tr>
        </table>
        <p><strong>
            <?php
                if (isset($_POST['cesar']) && !empty($_POST['texto']) && !empty($_POST['desplazamiento'])) {
                    echo $resultado;
                }

                if (isset($_POST['sustitucion']) && !empty($_POST['texto'])) {
                    echo $resultado;
                }
            ?>
        </strong></p>
    </form>
</body>
</html>