<?php 
// Función que devuelve un array con todas las categorias de la BBDD que tengan como minimo un item
function obtenerCategorias($conn) {
    // Se crea la consulta
    $sql = "SELECT * FROM CATEGORIAS WHERE EXISTS (SELECT ID_CAT FROM ITEMS WHERE ID_CAT = CATEGORIAS.ID)";
    // Se obtiene el resultado de la consulta en la BBDD
    $resultado = $conn->query($sql);
    // Si da error termina
    if($conn->errno) die($conn->error);
    // Se crea el array que devolveremos como resultado
    $categorias = array();
    // Bucle para leer el resultado de la consulta
    while($fila = $resultado -> fetch_assoc()) {
        // Se añade cada categoria al Array de categorias
        array_push($categorias, $fila);
    }
    // Se devuelve el array 
    return $categorias;
}

// Funcion para rellenar la tabla de items segun la categoria pasada
function rellenarTabla($conn, $id) {
    $user = '';
    if (isset($_SESSION['userID'])) 
        $user = $_SESSION['userID'];
    if ($id == -1) {
        $sql = "SELECT * FROM ITEMS";
    } else {
        $sql = "SELECT * FROM ITEMS WHERE ID_CAT = $id";
    }

    $resultado = $conn->query($sql);
    if($conn->errno) die($conn->error);

    while($fila = $resultado -> fetch_assoc()) {
        $id_item = $fila['id'];
        $img = unaImgDeItem($conn, $id_item);
        $nombre = $fila['nombre'];            

        $pujas = cantPujasDeItem($conn, $id_item);
        $pujaMax = pujaMasAltaDeItem($conn, $id_item);
        if ($pujaMax == null) 
            $pujaMax = $fila['preciopartida'];
        $pujaMax .= MONEDA;
        $fechaLimite = $fila['fechafin'];
        echo "<tr>";
        if ($img != 'SIN IMAGEN')
            echo "<td><img src='".$img."' width='250'></td>";
        else
            echo "<td><b>SIN IMAGEN</b></td>";
        if ($user == $fila['id_user'])
            echo "<td><a href='".DIR."php/itemdetalles.php?item=$id_item'>$nombre</a> - <a href='".DIR."php/editaritem.php?item=$id_item'>[Editar]</a></td>";
        else
            echo "<td><a href='".DIR."php/itemdetalles.php?item=$id_item'>$nombre</a></td>";
        echo "<td>$pujas</td>";
        echo "<td>$pujaMax</td>";
        echo "<td>$fechaLimite</td>";
        echo "</tr>";
    }
}

// Función que devuelve la imagen de un item
function unaImgDeItem($conn, $id_item) {
    $sql = "SELECT IMAGEN FROM IMAGENES WHERE ID_ITEM = $id_item";
    $imagen = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $imagen->fetch_assoc();
    if (isset($fila['IMAGEN']))
        return DIR.DIR_IMG.$fila['IMAGEN'];
    return 'SIN IMAGEN';
}

// Función que comprueba si existe la imagen pasada
function comprobarSiExisteImg($img) {
    $file_headers = @get_headers($img);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
        return false;
    else 
        return true;
}

// Función que muestra todas las imagenes de un item
function mostrarTodasImgDeItem($conn, $idItem) {
    $cont = 0;
    $sql = "SELECT IMAGEN FROM IMAGENES WHERE ID_ITEM = $idItem";
    $imagen = $conn->query($sql);
    if($conn->errno) die($conn->error);
    while ($fila = $imagen->fetch_assoc()) {
        $img = DIR.DIR_IMG.$fila['IMAGEN'];
        if (comprobarSiExisteImg($img)) {
            echo "<img src='".$img."' width='250'>";
            $cont++;
        }
    }
    if ($cont == 0)
        return 'SIN IMAGEN';
}

// Función que devuelve la cantidad de pujas de un item
function cantPujasDeItem($conn, $id_item) {
    $sql = "SELECT COUNT(*) 'PUJA' FROM PUJAS WHERE ID_ITEM = $id_item";
    $pujas = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $pujas = $pujas->fetch_assoc();
    return $pujas['PUJA'];
}

// Función que devuelve la puja más alta de un item
function pujaMasAltaDeItem($conn, $id_item) {
    $sql = "SELECT MAX(CANTIDAD) 'MAX' FROM PUJAS WHERE ID_ITEM = $id_item";
    $pujas = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $pujas = $pujas->fetch_assoc();
    return $pujas['MAX'];
}

// Función que muestra las caracteristicas de un item pasandole un id
function itemPorId($conn, $id_item) {
    $sql = "SELECT * FROM ITEMS WHERE ID = $id_item";
    $item = $conn->query($sql);
    if($conn->errno) die($conn->error);
    return $item->fetch_assoc();
}

// Función que comrpueba si existe un usuario en la bbdd
function comprobarSiExisteUsuario($conn, $user) {
    $sql = "SELECT USERNAME FROM USUARIOS WHERE USERNAME = '$user'";
    $usuario = $conn->query($sql);
    if($conn->errno) die($conn->error);
    while ($fila = $usuario->fetch_assoc()) {
        $userName = $fila['USERNAME'];
        if ($userName == $user) {
            echo '<div class="error">El usuario '.$user.' ya existe</div>';
            return true;
        } else {
            return false;
        }
    }
}

// Función que inserta un Usuario en la BBDD 
function insertarUsuario($conn, $user, $name, $passw, $email) {
    $strValidacion = generarStringRandom();
    //$sql = "INSERT INTO usuarios (username, nombre, password, email, cadenaverificacion, activo, falso) VALUES ('$user', '$name', '$passw', '$email', '$strValidacion', 0, 0)";
    
    /* Como no funciona el mail dejare el usuario como activo */
    $sql = "INSERT INTO usuarios (username, nombre, password, email, cadenaverificacion, activo, falso) VALUES ('$user', '$name', '$passw', '$email', '$strValidacion', 1, 0)";
    $conn->query($sql);
    if($conn->errno) die($conn->error); 
    //enviarEmail($strValidacion, $email, $user);
}

// Función que manda un correo al usuario para verificar la cuenta
/*
function enviarEmail($strValidacion, $email, $user) {
    $urlCadRandom=urlencode($strValidacion);
    $urlEmail=urlencode($email);
    $enlace="http://127.0.0.1/Subastas/pph/verificacion.php?email=$urlEmail&cadverif=$urlCadRandom"; 
    $mens=<<<MAIL
        Hola $user. Haz clic en el siguiente enlace para registrarte:
        $enlace
        Gracias
    MAIL;
    if (mail($email,"Registro en 127.0.0.1", $mens, "From:edgarmartinezdw2@gmail.com"))
        echo "Mensaje enviado";
    else
        echo "No se pudo enviar mensaje"; 

}
*/

// Función que genera un String Random de 16 caracteres
function generarStringRandom() {
    $randomstring="";
    for($i = 0; $i < 16; $i++) {
        $randomstring .= chr(mt_rand(32,126));
    }
    return $randomstring;
}

// Función que valida el login
function validarLogin($conn, $user, $passw) {
    $sql = "SELECT USERNAME, ACTIVO, ID FROM USUARIOS WHERE USERNAME = '$user' AND PASSWORD = '$passw'";
    $usuario = $conn->query($sql);
    if($conn->errno) die($conn->error);
    if ($usuario->num_rows == 0) {
        echo '<div class="error">El usuario '.$user.' no existe.</div>';
        return false;
    }
    while ($fila = $usuario->fetch_assoc()) {
        $userName = $fila['USERNAME'];
        $activo = $fila['ACTIVO'];
        $id = $fila['ID'];
        if ($activo == 0) {
            echo '<div class="error">El usuario '.$user.' no esta verificado.</div>';
            return false;
        } else 
            return $id;
    }
}

// Función que devuelve el nombre de un usuario pasandole el id
function obtenerNombreUsuario($conn, $id) {
    $sql = "SELECT USERNAME FROM USUARIOS WHERE ID='$id'";
    $user = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $user->fetch_assoc();
    return $fila['USERNAME'];
}

// Función que carga una lista con todas las pujas de un item
function cargarListaPujaItem($conn, $idItem) {
    $sql = "SELECT CANTIDAD, ID_USER FROM PUJAS WHERE ID_ITEM = '$idItem' ORDER BY CANTIDAD DESC";
    $pujas = $conn->query($sql);
    if($conn->errno) die($conn->error);
    if ($pujas->num_rows == 0) {
        echo '<div class="error">Aún no existe ninguna puja</div>';
        return;
    }
    echo "<ul>";
    while ($fila = $pujas->fetch_assoc()) {
        $user = obtenerNombreUsuario($conn, $fila['ID_USER']);
        $cantidad = $fila['CANTIDAD'];
        echo "<li>$user - $cantidad".MONEDA."</li>";
    }
    echo "</ul>";
}

// Función que devuelve la cantidad de pujas que ha realizado un usuario sobre un item hoy
function cantPujasDeUsuarioItemHoy($conn, $idItem, $idUser) {
    $fechaHoy = date('Y-m-d');
    $sql = "SELECT COUNT(*) CONT FROM PUJAS WHERE ID_ITEM = '$idItem' AND ID_USER = '$idUser' AND FECHA = '$fechaHoy'";
    $pujas = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $pujas->fetch_assoc();
    return $fila['CONT'];
}

// Función que añade una puja
function aniadirPuja($conn, $idItem, $idUser, $cantidad) {
    $fechaHoy = date('Y-m-d');
    $sql = "INSERT INTO PUJAS (ID_ITEM, ID_USER, CANTIDAD, FECHA) VALUES ('$idItem', '$idUser', '$cantidad', '$fechaHoy')";
    $pujas = $conn->query($sql);
    if($conn->errno) die($conn->error);
}

// Función para cargar las categorias de la BBDD en la tabla
function cargarCategoriasEnTabla($conn) {
    $sql = "SELECT * FROM CATEGORIAS";
    $categorias = $conn->query($sql);
    if($conn->errno) die($conn->error);
    while ($fila = $categorias->fetch_assoc()) {
        $id = $fila['id'];
        $nombre = $fila['categoria'];
        echo "<option value='$id'>$nombre</option>";
    }
}

// Función que comprueba el formulario de Añadir Item
function comprobarFormulario() {
    $errores = 0;
    // Nombre
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        if ($nombre == '') {
            echo '<div class="error">El nombre no puede estar vacio</div>';
            $errores++;
        }
    }
    if (isset($_POST['descripcion'])) {
        $descripcion = $_POST['descripcion'];
        if ($descripcion == '') {
            echo '<div class="error">La descripción no puede estar vacia</div>';
            $errores++;
        }     
    }
    if (isset($_POST['fecha'])) {
        $fechaFin = $_POST['fecha'];
        $fechaHoy = date('Y-m-d');
        if ($fechaFin < $fechaHoy) {
            echo '<div class="error">La fecha tiene que ser posterior a la fecha actual</div>';
            $errores++;
        }   
    }
    if (isset($_POST['precio'])) {
        $precio = $_POST['precio'];
        if ($precio < 0) {
            echo '<div class="error">El precio no puede ser negativo</div>';
            $errores++;
        }
    }
    return $errores;
}

// Función que guarda un item en la BBDD
function guardarItemEnBBDD($conn) {
    $userID = $_SESSION['userID'];
    $idCat = $_POST['categoria'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fechaFin = $_POST['fecha'];
    $precio = $_POST['precio'];
    $sql = "INSERT INTO ITEMS (id_cat, id_user, nombre, preciopartida, descripcion, fechafin) VALUES ('$idCat','$userID', '$nombre', '$precio', '$descripcion', '$fechaFin')";
    $categorias = $conn->query($sql);
    if($conn->errno) die($conn->error);
    return obtenerIdDeItemPorNombreYFechaFin($conn, $nombre, $fechaFin);
}

// Función que devuelve el id de un item pasandole el nombre y la fecha de fin
function obtenerIdDeItemPorNombreYFechaFin($conn, $nombre, $fechaFin) {
    $sql = "SELECT ID FROM ITEMS WHERE NOMBRE = '$nombre' AND FECHAFIN = '$fechaFin'";
    $item = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $item->fetch_assoc();
    return $fila['ID'];
}

// Función que devuelve el id del creador de un item
function idUserDeItem($conn, $idItem) {
    $sql = "SELECT ID_USER FROM ITEMS WHERE ID = '$idItem'";
    $item = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $item->fetch_assoc();
    return $fila['ID_USER'];
}

// Mostrar imagenes de un item en forma de tabla para editarItem.php
function mostrarTodasImgDeItemEnTabla($conn, $idItem) {
    $sql = "SELECT IMAGEN, ID FROM IMAGENES WHERE ID_ITEM = $idItem";
    $imagen = $conn->query($sql);
    if($conn->errno) die($conn->error);
    if ($imagen->num_rows > 0) {
        echo "<table>";
        while ($fila = $imagen->fetch_assoc()) {
            $img = DIR.DIR_IMG.$fila['IMAGEN'];
            if (comprobarSiExisteImg($img)) {
                echo "<tr>";
                echo "<td><img src='".$img."' width='250'></td>";
                echo "<td><a href='?item=$idItem&borrar=".$fila['ID']."'>[BORRAR]</a></td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    } else
        return 'SIN IMAGEN';
}

// Funcion para obtener la ruta de una imagen pasandole el id de la imagen
function obtenerRutaIMG($conn, $idImg) {
    $sql = "SELECT IMAGEN FROM IMAGENES WHERE ID = '$idImg'";
    $imagen = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $imagen->fetch_assoc();
    $ruta = "../".DIR_IMG.$fila['IMAGEN'];
    return $ruta;
}

// Función que borra una imagen de la BBDD y del directorio
function borrarImg($conn, $idImg) {
    if (unlink(obtenerRutaIMG($conn, $idImg))) {
    // Borrar de la BBDD
        $sql = "DELETE FROM IMAGENES WHERE ID = '$idImg'";
        $imagen = $conn->query($sql);
        if($conn->errno) die($conn->error);
    }
} 

// Función para comprobar si existe una img en el servidor y la BBDD
function comprobarImgEnServerYBBDD($conn, $nom) {
    $sql = "SELECT ID FROM IMAGENES WHERE IMAGEN = '$nom'";
    $imagen = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $imagen->fetch_assoc();
    var_dump($fila);
    return $fila;
}


// Funcion para guardar una img en el servidor y en la BBDD
function guardarImg($conn, $idItem) {
    // Guardar en Servidor
    $tmpFile = $_FILES['img']['tmp_name'];
    $nombre = $_FILES['img']['name'];  
    $extension = substr($nombre, strrpos($nombre, '.'), strlen($nombre));
    $nombre= substr($nombre, 0, strrpos($nombre, '.'));
    $aux = $nombre.$extension;
    $cont = 01;
    while (comprobarImgEnServerYBBDD($conn, $aux) != null) {
        $aux= $nombre.'_'.$cont.$extension;
        var_dump($aux);
        comprobarImgEnServerYBBDD($conn, $nombre);
        $cont++;
    }
    $newFile = "../".DIR_IMG.$aux;
    move_uploaded_file($tmpFile, $newFile);
    // Guardar en BBDD
    $sql = "INSERT INTO IMAGENES (id_item, imagen) VALUES ('$idItem', '$aux')";
    $conn->query($sql);
    if($conn->errno) die($conn->error);
}

// Función para cambiar el precio partida
function cambiarPrecioPartida($conn, $idItem, $precioPartida) {
    $sql = "UPDATE items SET preciopartida = '$precioPartida' WHERE id = '$idItem'";
    $conn->query($sql);
    if($conn->errno) die($conn->error);
    header("Location: editarItem?item=$idItem");
}

// Función para cambiar la fechafin de un item
function cambiarFechaFin($conn, $idItem, $numHoras) {
    if ($numHoras == '24')
        $sql = "UPDATE ITEMS SET FECHAFIN = date_add(FECHAFIN, interval 1 day) WHERE ID = '$idItem'";
    else
        $sql = "UPDATE ITEMS SET FECHAFIN = date_add(FECHAFIN, interval 1 hour) WHERE ID = '$idItem'";
    $conn->query($sql);
    if($conn->errno) die($conn->error);
    header("Location: editarItem?item=$idItem");
}

// Función que devuelve el ganador de un item
function ganadorItem($conn, $idItem) {
    $sql = "SELECT NOMBRE 
            FROM USUARIOS 
            WHERE EXISTS ( 
                SELECT ID 
                FROM PUJAS 
                WHERE ID_ITEM = '$idItem' 
                AND ID_USER = USUARIOS.ID
                AND CANTIDAD = ( 
                    SELECT MAX(CANTIDAD) 
                    FROM PUJAS
                    WHERE ID_ITEM = '$idItem' 
                ) 
            );";
    $ganador = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $ganador = $ganador->fetch_assoc();
    if (isset($ganador['NOMBRE']))
        return $ganador['NOMBRE'];
    else 
        return 'SIN GANADOR';
}

// Función para visualizar los items vencidos en forma de tabla (vencidas.php)
function aniadirSubastasVencidas($conn) {
    $sql = "SELECT * FROM ITEMS WHERE FECHAFIN <= CURRENT_DATE";
    $items = $conn->query($sql);
    if($conn->errno) die($conn->error);
    while ($fila = $items->fetch_assoc()) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='item[]' value='".$fila['id']."'></input></td>";
        echo "<td><a title='".$fila['descripcion']."' href='itemdetalles.php?item=".$fila['id']."'>".$fila['nombre']."</a></td>";
        $pujaFinal = pujaMasAltaDeItem($conn, $fila['id']);
        if ($pujaFinal == null)
            $pujaFinal = 0;
        echo "<td>PRECIO FINAL: $pujaFinal".MONEDA."</td>";
        echo "<td>".ganadorItem($conn, $fila['id'])."</td>";
        echo "</tr>";
    }
}

// Función que borra todos los datos de un item de la BBDD
function borrarItemDeLaBBDD($conn, $idItem) {
    // Borrar pujas
    $sql = "DELETE FROM PUJAS WHERE ID_ITEM = '$idItem'";
    $conn->query($sql);
    if($conn->errno) die($conn->error);
    // Borrar IMG
    borrarTodasLasImgDeItem($conn, $idItem);
    // Borrar Item
    $sql = "DELETE FROM ITEMS WHERE ID = '$idItem'";
    $conn->query($sql);
    if($conn->errno) die($conn->error);
}

// Funcion que borra todas las imagenes de un item pasado como id
function borrarTodasLasImgDeItem($conn, $idItem) {
    $sql = "SELECT ID FROM IMAGENES WHERE ID_ITEM = '$idItem'";
    $imagenes = $conn->query($sql);
    if($conn->errno) die($conn->error);
    while ($imagen = $imagenes->fetch_assoc()) {
        borrarImg($conn, $imagen['ID']);
    }
}
?>