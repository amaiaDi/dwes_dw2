<?php

// EJERCICIO 1
// Funcion al pulsar "CIFRADO CESAR"
function cesarPulsado() {
    // Comprobación de errores
    if (empty($_POST['txt']))
        $errores[] = "El texto a cifrar es requerido";
    if (empty($_POST['desplazamiento']))
        $errores[] = "Es necesario especificar el desplazamiento";
    // Cuando hay errores se escriben
    if (count($errores) > 0) {
        foreach($errores as $error) {
            echo "<p>$error</p>";
        }
    // Cuando no hay errores se realiza el cifrado 
    } else {
        $txt = strtoupper($_POST['txt']);
        $desp = $_POST['desplazamiento'];
        echo "<h2>Texto cifrado: ".cesar($txt, $desp)."</h2>";
    }
}

// Funcion al pulsar "CIFRADO POR SUSTITUCION"
function sustitucionPulsado() {
    // Comprobación de posible error
    if (empty($_POST['txt']))
        echo "<p>El texto a cifrar es requerido<p>";
    // Cuando no hay errores se realiza el cifrado 
    else {
        $txt = strtoupper($_POST['txt']);
        $fichero = $_POST['clave'];
        echo "<h2>Texto cifrado: ".sustitucion($txt, $fichero)."</h2>";
    }
}
// Función que realiza el cifrado César
function cesar($txt, $desp) {
    $resultado = "";
    for ($i=0; $i < strlen($txt); $i++) {
        $carAsci = ord($txt[$i]);
        if (($carAsci+$desp)>ord('Z')) {
            $carAsci -= 26;
        }
        $resultado .= chr($carAsci+$desp);
    }
    return $resultado;
}
// Función que realiza el "CIFRADO POR SUSTITUCION"
function sustitucion($txt, $fichero) {
    $f = fopen(DIR.$fichero, 'r');
    $claves = fgets($f);
    fclose($f);
    $arrClaves = array();
    $letra = 'A';
    for ($i = 0; $i < strlen($claves); $i++){
        $arrClaves[$letra] = $claves[$i];
        $letra++;
    }
    return strtr($txt, $arrClaves);
}

// EJERCICIO 2
function arrImg($dirImg) {
    // Se eliminan los directorios '.' y '..' y se queda con las imagenes que hay
    $arrExt = array ("jpg", "png", "webp");
    $ficheros = array_slice(scandir($dirImg), 2, count(scandir($dirImg)));
    $imagenes = array();
    for ($i = 0; $i < count($ficheros); $i++) {
        $partes_ruta = pathinfo($ficheros[$i]);
        if (in_array($partes_ruta['extension'], $arrExt)){
            $imagenes[] = $ficheros[$i];
        }
    }
    return $imagenes;
}

// Función que crea las opciones para seleccionar el número de imágenes
function cuantasOpeciones($dirImg) {
    $imagenes = arrImg($dirImg);
    for ($i = 2; $i <= count($imagenes); $i++) {
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
}

// Función que devuelve un array con imágenes random sin repetir
function arrImgConRuta($dirImg) {
    $imagenes = arrImg($dirImg);
    $imgConRuta = array();
    foreach ($imagenes as $imagen) {
        $imgConRuta[] = $dirImg.$imagen;
    }
    return $imgConRuta;
}

function random($cantImg, $dirImg) {
    $rand = array_rand(arrImgConRuta($dirImg), $cantImg);
    $todasImg = arrImgConRuta($dirImg);
    $imgRandom = array();
    for ($i = 0; $i < $cantImg; $i++) {
        $imgRandom[$i] = $todasImg[$rand[$i]];
    }
    return $imgRandom;
}

// Función que construye la con imagenes
function construirTabla($cantImg, $imagenes) {
    echo '<table>';
    foreach ($imagenes as $imagen) {
        echo '<tr>';
        echo "<td><img src='$imagen' width='350'></td>";
        echo "<td><input type='checkbox' name='meGusta[]' value='$imagen'><label>Me gusta</label><br></td>";
        echo '</tr>';
    }
    echo '</table>';
    return $imagenes;
}

// Función para escribir en el fichero 
function escribirFichero($fich, $meGusta) {
    $ip = getHostByName(getHostName());
    $f = fopen($fich, 'a');
    $linea = $ip.":\t";
    foreach($meGusta as $img) {
        $linea .= substr($img, strpos($img, "/", strpos($img, "/")+1)+1, strlen($img))."\t";
    }
    $linea .= "\n";
    fwrite($f, $linea, strlen($linea));
    fclose($f);
}

// Ejercicio 3

// Función para crear la tabla
function crearTablaPedidos($art, $ruta) {
    // Comprobar si existe el fichero
    if (file_exists($art)) {
        // Abrir el fichero
        $f = fopen($art, 'r');
        if (!isset($_GET['total'])) {
            $total = 0;
        } else {
            $total = $_GET['total'] + $_GET['precio']; 
        }
        
        echo "<table>";
        echo "<tr><th colspan='3' class='titulo'>ELIGE TU PEDIDO</th></tr>";
        // Array con ficheros
        $arrFicheros = scandir($ruta);
        // Recorrer el fichero
        while (!feof($f)) {
            $linea = fgets($f);
            $linea = explode(';', $linea);
            if (count($linea) != 1) {
                $fich = $linea[0].'.txt';
                echo "<tr>";
                echo "<td>$linea[0]</td>";
                echo "<td>$linea[1]</td>";
                echo "<td><a href='pedido.php?precio=$linea[1]&total=$total'>Añadir Unidad</a></td>";
                if (in_array($fich, $arrFicheros))
                    echo "<td><a href='$ruta$fich'>Más Información</a></td>";
                echo "</tr>";
            }
        }
        echo "<tr><th colspan='3' class='titulo'>TOTAL: $total €</th></tr>";
        echo "</tabe>";
        fclose($f);
    }
}

// Función para añadir un nuevo articulo
function articuloNuevo($fichero, $ruta) {
    $errores = array();
    if ($_POST['nombre'] == '')
        $errores[] = "Debes introducir el nombre del nuevo producto";
    if ($_POST['precio'] == '')
        $errores[] = "Debers introducir el precio del nuevo producto";
    if ($_POST['precio'] <= 0)
        $errores[] = "El precio debe ser un valor prositivo";
    if (is_uploaded_file($_FILES['fich']['tmp_name'])) {
        if (pathinfo($_FILES['fich']['name'])['extension'] != 'txt')
            $errores[] = "El fichero debe ser .txt";
    }
    
    if (count($errores) > 0) {
        foreach($errores as $error) {
            echo "<p>$error</p>";
        }
    } else {
        if (is_uploaded_file($_FILES['fich']['tmp_name'])) {
            move_uploaded_file($_FILES['fich']['tmp_name'], $ruta.$_POST['nombre'].".txt");
        }
        $f = fopen($fichero, 'a');
        $linea = $_POST['nombre'].';'.$_POST['precio']."\n";
        fwrite($f, $linea, strlen($linea));
        fclose($f);
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

// Ejercicio 5

// Validar campos user passw
function validarUsuario() {
    // Array para guardar errores
    $errores = array();
    // Si el campo x esta vacio se guarda en el array
    if ($_POST['user'] == '') 
        $errores[] = "ERROR";
    if ($_POST['passw'] == '') 
        $errores[] = "ERROR";
    // Si hay algun campo vacio se reenvia a login.php con el codigo del error
    if (count($errores) > 0) 
        return 0;
    // Si no hay ningun campo vacio se abre el fichero
    else {
        $user = $_POST['user'];
        $passw = $_POST['passw'];
        $f = fopen(FichUSER, 'r');
        // Variables para saber que tipo de error dar si hay alguno
        $usuarioEncontrado = false;
        $encontradoSinPassw = false;
        // Mientras queden lineas por leer y el usuario no haya sido encontrado
        while (!feof($f) and $usuarioEncontrado == false) {
            // Se lee una linea
            $linea = fgets($f);
            // Se separa la linea por el separador (;) que se encuentra en el fichero
            $linea = explode(";", $linea);
            // Se comprueba que existan los campos exactos
            if (count($linea) == 2) {
                // Si el usuario leido coincide con el usuario que se esta buscando se cambia la variable $usuarioEncontrado a verdadero
                if ($linea[0] == $user) {
                    $usuarioEncontrado = true;
                    // Si las contraseñas no coinciden se cambiara la variable $encontradoSinPassw a verdadero 
                    if ($linea[1] != $passw)
                        $encontradoSinPassw = true;
                }   
            }     
        }
        // Entramos si se ha encontrado al usuario
        if ($usuarioEncontrado) {
            // Si no coinciden las contraseñas devolveremos el codigo de error 1
            if ($encontradoSinPassw) 
                return 1;
            // Si no es que las contraseñas coinciden por lo que los datos introducidos son correctos 
            else {
                return 2;
            }
        } else // Si la cuenta no existe se devuelve 3
            return 3;        
    }
}


// Controlar errores validación
function controlarErrores($codError, $user) {
    switch ($codError) {
        case 0:
            echo "<p>No puede haber campos vacios</p>";
            break;
        case 1:
            echo "<p>CONTRASEÑA ERRONEA PARA <b>$user</b></p>";
            echo "<p>Inténtalo de nuevo</p>";
            break;
        case 2:
            echo "<p>EL USUARIO <b>$user</b> YA EXISTE</p>";
            break;
    }
}

// Función que escribe un usuario en el fichero
function guardarUsuario($user, $passw, $fich) {
    $f = fopen($fich, 'a');
    $linea = "\n".$user.";".$passw;
    fwrite($f, $linea, strlen($linea));
    fclose($f);
}

?>