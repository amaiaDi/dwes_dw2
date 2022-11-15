<?php
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

    /**
     * Función para crear cadena de verificación
     */
    function crearCadenaVerificacion(){
        $randomstring="";
        for($i = 0; $i < 16; $i++) {
            $randomstring .= chr(mt_rand(32,126));
        }
        return $randomstring;
    }

     /**
     * Función para obtener la ruta del fichero verificacion.php para crear la ruta de envío
     */
    function obtenerRutaFicheroHTTP(){
        //Obtenemos la ruta completa del fichero desde donde se esta ejecutando el metodo y los metemos en un array asociativo
        $partes_ruta = pathinfo($_SERVER['HTTP_REFERER']);

        //Obenemos la parte relacionada con el directorio. Podriamos elegir tambien (basename,extension,filename)
        $directorio= $partes_ruta['dirname'];

        return $directorio;
    }

    
     /**
     * Función para obtener la ruta del fichero verificacion.php para crear la ruta de envío
     */
    function obtenerRutaFichero(){
        //Obtenemos la ruta completa del fichero desde donde se esta ejecutando el metodo y los metemos en un array asociativo
        $partes_ruta = pathinfo($_SERVER['SCRIPT_FILENAME']);

        //Obenemos la parte relacionada con el directorio. Podriamos elegir tambien (basename,extension,filename)
        $directorio= $partes_ruta['dirname'];

        return $directorio;
    }

    /**
     * Función para comprobar Mail
     */
    function comprobarMail($mail, $cadena_verif){
        global $con;
        $mail_sql = SQL_REGISTRO_EMAIL." '$mail'";
        $mail_result = mysqli_query($con, $mail_sql);
        while($mail_row = mysqli_fetch_assoc($mail_result)){
            $mail_verif = $mail_row['email'];
            $cad_verif = $mail_row['cadenaverificacion'];
        }
        if($mail == $mail_verif && $cadena_verif == $cad_verif){
            return true;
        }
        return false;
    }

    /**
     * Función para obtener el ID de usuaario mediante el email
     */
    function getIdUsuarioEmail($mail){
        global $con;
        $mail_sql = SQL_ID_USUARIO_BY_EMAIL." '$mail'";
        $mail_result = mysqli_query($con, $mail_sql);
        while($mail_row = mysqli_fetch_assoc($mail_result)){
            $id = $mail_row['id'];
        }
        return $id;
    }
    /**
     * Función para activar el usuario una vez registrado
     */
    function darUsuarioAlta($id_user){
        global $con;
        $mail_sql = SQL_UPDATE_USUARIO_ACTIVO_WHERE_ID." $id_user";
        mysqli_query($con, $mail_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    /**
     * Función para insetar usuario
     */
    function insertarUsuario($usuario, $nombre, $pass, $email, $cadena){
        global $con;
        $insert_sql = SQL_INSERT_USUARIO." NULL, '$usuario', '$nombre', '$pass', '$email', '$cadena', '0');";
        mysqli_query($con, $insert_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    /**
     * Función para comprobar si el usuario existe
     */
    function existeUsuario($usuario){
        global $con;
        $buscar_sql = SQL_DATOS_USUARIO_POR_USERNAME." '$usuario'";
        $buscar_result = mysqli_query($con, $buscar_sql);
       
        if(mysqli_num_rows($buscar_result) != 0){
            return true;
        }
       
        return false;
    }
    /**
     * Función para comprobar usuario y password de logueo
     */
    // devuelve 1: usuario y contraseña correctos, usuario verificado
    //          2: usuario y contraseña correctos, usuario NO verificado
    //          3: usuario o contraseña incorrectos
    function comprobarLogin($usuario, $password){
        global $con;
        $comprobar_sql = SQL_USERNAME_PASSWORD_USUARIOS;
        $comprobar_result = mysqli_query($con, $comprobar_sql);
        while($comprobar_row = mysqli_fetch_assoc($comprobar_result)){
            $usu = $comprobar_row['username'];
            $pass =  $comprobar_row['password'];
            $acti = $comprobar_row['activo'];
            if($usu == $usuario && $pass == $password){
                if($acti == 1){
                    return 1;
                }
                else {
                    return 2;
                }
            }
        }
        return 3;
    }

    /**
     * Función para obtener listado de categoias
     */
    function obtenerCategorias(){
        global $con;
        $categorias = [];
        $cat_sql = SQL_TODAS_CATEGORIAS;
        $cat_result = mysqli_query($con,$cat_sql);
        while($cat_row = mysqli_fetch_assoc($cat_result)) {
            array_push($categorias, ucfirst($cat_row['categoria']));
        }
        return $categorias;
    }

    /**
     * Función para obtener el numero de pujas
     */
    function getCantidadPujas($id_item){
        global $con;
        $count_pujas_sql = SQL_COUNT_PUJAS." $id_item;";
        $pujas_result = mysqli_query($con, $count_pujas_sql);
        while($pujas_row = mysqli_fetch_assoc($pujas_result)){
            $cuenta = $pujas_row['cuenta'];
        }
        return $cuenta;
    }

    /**
     * Función para obtener el precio maximo de una puja en base al id de item
     */
    function getPrecioMaximo($id_item){
        global $con;
        $precio_sql = SQL_PRECIOPARTIDA_ITEMS." $id_item";
        $precio_result = mysqli_query($con, $precio_sql);
        while($precio_row = mysqli_fetch_assoc($precio_result)){
            $precio_item = $precio_row['preciopartida'];
        }

        $precio_max_sql = SQL_MAX_CANTIDAD_PUJA." $id_item";
        $precio_max_result = mysqli_query($con, $precio_max_sql);
        while($precio_row = mysqli_fetch_assoc($precio_max_result)){
            $precio_max = $precio_row['cant'];
            if($precio_max == null){
                $precio = $precio_item;
            } else {
                $precio = $precio_max;
            }
            
        }
        return $precio;
    }

    /**
     * Función para modificar la fecha de fin de puja
     */
    function getFechaFinPuja($id_item){
        global $con;
        $fecha_sql = SQL_FECHAFIN_ITEMS." $id_item";
        $fecha_result = mysqli_query($con, $fecha_sql);
        while($fecha_row = mysqli_fetch_assoc($fecha_result)){
            $fecha = $fecha_row['fechafin'];
        }
        return $fecha;
    }

    /**
     * Función para obtener imagenes en base al id de item
     */
    function obtenerImagenes($id_item){
        global $con;
        $img_sql = SQL_IMAGEN_BY_ID." $id_item";
        $img_result = mysqli_query($con, $img_sql);
        $arr_img = [];
        while($img_row = mysqli_fetch_assoc($img_result)){
            $img = $img_row['imagen'];
            array_push($arr_img, CARPETA_IMAGENES . "/" . $img);
        }
        return $arr_img;
    }

     /**
     * Función para obtener la descripción de item en base al id
     */
    function obtenerDescripcion($id_item){
        global $con;
        $desc_sql = SQL_DESCRIPCION_ITEMS_BY_ID." $id_item";
        $desc_result = mysqli_query($con, $desc_sql);
        while($desc_row = mysqli_fetch_assoc($desc_result)){
            $desc = $desc_row['descripcion'];
        }
        return $desc;
    }

    /**
     * Función para obtener el Historial  en base al id de item odenado por cantidad de fora descendente
     */
    function obtenerHistorial($id_item){
        global $con;
        $historial = [];
        $histo_sql = SQL_USERNAME_CANTIDAD_PUJAS_USUARIOS_BY_ID." $id_item ".SQL_ORDERBY_CANTIDAD_DESC;

        $histo_result = mysqli_query($con, $histo_sql);
        while($histo_row = mysqli_fetch_assoc($histo_result)){
            $moneda = TIPO_MONEDA;
            $linea = ucfirst($histo_row['username']) . " - " . $histo_row['cantidad'] . $moneda;
            array_push($historial, $linea);
        }
        return $historial;
    }

    /**
     * Función para obtener el id de usuario por username
     */
    function getIdUsuario($nombre){
        global $con;
        $usu_sql = SQL_ID_FROM_USUARIOS_BY_USERNAME."'$nombre';";
        $usu_result = mysqli_query($con, $usu_sql);
        $id;
        while($usu_row = mysqli_fetch_assoc($usu_result)){
            $id = $usu_row['id'];
        }
        return $id;
    }

     /**
     * Función para obtener el nombre de usuario por id
     */
    function getNombreUsuario($id_usuario){
        global $con;
        $usu_sql = SQL_NOMBRE_FROM_USUARIOS_BY_ID."'$id_usuario';";
        $usu_result = mysqli_query($con, $usu_sql);
        while($usu_row = mysqli_fetch_assoc($usu_result)){
            $nombre = $usu_row['nombre'];
        }
        return $nombre;
    }

     /**
     * Función para obtener el id de categoria por nombre de categoria
     */
    function getIdCategoria($nombre){
        global $con;
        $nombre = strtolower($nombre);
        $cat_sql = SQL_ID_CATEGORIAS_BY_CATEGORIA."'$nombre';";
        $cat_result = mysqli_query($con, $cat_sql);
        while($cat_row = mysqli_fetch_assoc($cat_result)){
            $id = $cat_row['id'];
        }
        return $id;
    }

     /**
     * Función para obtener el id de item por nombre
     */
    function getIdItem($nombre){
        global $con;
        $item_sql = SQL_ID_ITEMS_BY_NOMBRE."'$nombre';";
        $item_result = mysqli_query($con, $item_sql);
        while($item_row = mysqli_fetch_assoc($item_result)){
            $id = $item_row['id'];
        }
        return $id;
    }

     /**
     * Función para obtener el nombre en base al id de items
     */
    function getNombreItem($id){
        global $con;
        $item_sql = SQL_NOMBRE_ITEMS_BY_ID."'$id';";
        $item_result = mysqli_query($con, $item_sql);
        
        while($item_row = mysqli_fetch_assoc($item_result)){
            $nombre = $item_row['nombre'];
        }
        return $nombre;
    }
    
     /**
     * Función para insertar una puja
     */
    function insertarPuja($id_item, $usuario, $cantidad){
        global $con;
        $id_user = getIdUsuario($usuario);
        $fecha = date("Y-m-d");
        $insert_sql = SQL_INSERT_PUJAS."NULL, '$id_item', '$id_user', '$cantidad', '$fecha');";
        mysqli_query($con, $insert_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

     /**
     * Función para contar el numeroo de pujas en basae a la fecha, id item e id usuario
     */
    function getPujasUsuario($id_item, $usuario){
        global $con;
        $id_user = getIdUsuario($usuario);
        $contar_sql = SQL_COUNT_PUJAS_BY_FECHAS." and id_item = '$id_item' and id_user = '$id_user');";
        $contar_result = mysqli_query($con, $contar_sql);
        while($contar_row = mysqli_fetch_assoc($contar_result)){
            $contar = $contar_row['cuenta'];
        }
        if(mysqli_errno($con)) die(mysqli_error($con)); 
        return $contar;
    }

    /**
     * Función para cargar fechas en base al tipo
     */
    function cargarFecha($tipo){
        $tipos = [
            "dia" => 31,
            "mes" => 12,
            "anio" => date("Y") + 5,
            "hora" => 23,
            "minutos" => 59
        ];
        $comienzo = 1;
        if($tipo == "hora" || $tipo == "minutos"){
            $comienzo = 0;
        }
        if($tipo == "anio"){
            $comienzo = date("Y");
        }
        $fin = $tipos[$tipo];
        $i = 0;
        $resultado = "";
        for($i = $comienzo; $i <= $fin; $i++){
            if($i<10){
                $i = 0 . $i;
            }
            $resultado .= "<option>$i</option>";
        }
        return $resultado;
    }

    /**
     * Función para crear  la fecha completa
     */
    function crearFechaCompleta(){
        $tipos = ["dia", "mes", "anio", "hora", "minutos"];
        foreach($tipos as $tipo){
            $resul = cargarFecha($tipo);
            echo "<td>
                    <select name=$tipo>
                        echo $resul;
                    </select>
                 </td>";
        }
    }

     /**
     * Función para validar el formulario de nuevo item
     */
    function validarNuevoItem($nombre, $descripcion, $precio, $fecha){
        $mensaje_error = "";
        if($fecha < time()) $mensaje_error .= "<p>* ".MSJ_VALIDACION_ERROR_FECHA."</p>";
        if(empty($nombre)) $mensaje_error .= "<p>* ".MSJ_VALIDACION_ERROR_NOMBRE."</p>";
        if(empty($descripcion)) $mensaje_error .= "<p>* ".MSJ_VALIDACION_ERROR_DESCRIPCION."</p>";
        if(empty($precio)) $mensaje_error .= "<p>* ".MSJ_VALIDACION_ERROR_PRECIO."</p>";
        if(!is_numeric($precio)) $mensaje_error .= "<p>* ".MSJ_VALIDACION_ERROR_PRECIO_NUM."</p>";
        return $mensaje_error;
    }

     /**
     * Función para insertar un nuevo item
     */
    function insertarItem($id_categoria, $id_usuario, $nombre, $precio, $descripcion, $fecha){
        global $con;
        $insertar_sql = SQL_INSERT_ITEMS."NULL, '$id_categoria', '$id_usuario', '$nombre', '$precio', 
                         '$descripcion', '$fecha');";
        mysqli_query($con, $insertar_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    function existeItemCategoriaNombre( $nombre,$id_categoria){
        global $con;

        $count_sql = SQL_ID_ITEMS." where id_cat='$id_categoria' and nombre= '$nombre'";
        $resultado=mysqli_query($con, $count_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 

        return mysqli_num_rows($resultado)>0;
    }

    /**
     * Función para TODO-COMPROBAR FUNCIONAMieNTO
     */
    function esDuenio($usuario, $id_item){
        global $con;
        $id_usuario = getIdUsuario($usuario);
        $duenio_sql = SQL_COUNT_ITEMS." where id_user = '$id_usuario' and id = $id_item;";
        $duenio_result = mysqli_query($con, $duenio_sql);
        while($duenio_row = mysqli_fetch_assoc($duenio_result)){
            $cont = $duenio_row['count(id)'];
            if($cont == 1){
                return true;
            }
        }
        return false;
    }

     /**
     * Función para modificar el precio de partida de un item en case a su id de item
     */
    function modificarPrecio($id_item, $cantidad, $precio_anterior, $tipo){
        global $con;
        if($tipo == "bajar") $nuevo_precio = $precio_anterior - $cantidad ;
        elseif ($tipo == "subir") $nuevo_precio = $precio_anterior + $cantidad ;
        $modif_sql = "UPDATE items SET preciopartida = $nuevo_precio WHERE items.id = $id_item";
        mysqli_query($con, $modif_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

     /**
     * Función para posponer la fecha de fin de puja
     */
    function posponer($tiempo, $id_item){
        global $con;
        $fecha = getFechaFinPuja($id_item);
        $fecha = new DateTime($fecha);
        $fecha -> modify("+ 1 $tiempo");
        $nueva_fecha = $fecha -> format('Y-m-d H:i:s');
        $posp_sql = "update items set fechafin = '$nueva_fecha' where id = $id_item;";
        mysqli_query($con, $posp_sql);
    }

     /**
     * Función para obtener el nombre de la imagen
     * recupera el nombre completo de BD y si ya existe uno 
     * reestructura el nombre para añadirle un sufijo numerico
     */
    function getNombreImagen($nombre_img_orig, $id_item){
        global $con;
        $partir_nombre = explode(".", $nombre_img_orig);
        $nombre = $partir_nombre[0];
        $extension = $partir_nombre[1];
        $arr_nombres = [];
        
        //Buscamos la imagen en BD
        $imagen_sql = "select imagen from imagenes where imagen like '$nombre%.$extension' and id_item = $id_item;";
        $imagen_result = mysqli_query($con, $imagen_sql);
        
        //En base al resultado se crea un array con nombre y extension por separado
        while($imagen_row = mysqli_fetch_assoc($imagen_result)){
            $nombre_parecido = $imagen_row['imagen'];
            array_push($arr_nombres, $nombre_parecido);
        }
        //Si el array de nombres esta vacio, se mantiene el original
        if(count($arr_nombres) == 0){
            $nombre_final = $nombre_img_orig;
        }
        //Si no, se trata la codificación añadiendo un sufijo numerico tras el nombre y antes de la extension
        else {
            $arr_numeros = [];
            foreach($arr_nombres as $nom){
                $nom_sin_extension = explode(".",$nom)[0];
                $numero = explode($nombre,$nom_sin_extension)[1];
                array_push($arr_numeros, $numero);
            }
            $arr_num = [];
            foreach($arr_numeros as $num){
                $num_final = substr($num, strlen($num)-2);
                // $num_final++;
                array_push($arr_num, $num_final);
            }
            $num_max = max($arr_num);
            $n = $num_max + 1;
            if($n < 10){
                $n = "0" . $n;
            }
            $nombre_final = $nombre . "_" . $n . "." .$extension;
        }
        return $nombre_final;
    }
    
     /**
     * Función para insertar ruta de imagen en BD
     */
    function insertarImagen($id_item, $nombre_imagen){
        global $con;
        $ins_img_sql = SQL_INSERT_IMAGES."(null, $id_item, '$nombre_imagen');";
        $ins_img_result = mysqli_query($con, $ins_img_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }
    
     /**
     * Función eliminar imagen de BD en base a la ruta
     */
    function eliminarImagenBBDD($ruta){
        global $con;
        $eliminar_sql = SQL_DELETE_IMAGENES_BY_IMAGEN." '$ruta'";
        mysqli_query($con, $eliminar_sql);
    }

     /**
     * Función para eliminar la imagen de la ruta de local
     */
    function eliminarImagenLocal($ruta){
        $ruta_completa = "img/" . $ruta;
        unlink($ruta_completa);
    }

         /**
     * Función para eliminar la imagen de la ruta de local
     */
    function existeImagen( $nombre_imagen, $id_item){
        global $con;

        $imagen_sql = "select imagen from imagenes where imagen like '$nombre_imagen%' and id_item = $id_item;";
        $imagen_result = mysqli_query($con, $imagen_sql);
       
        if(mysqli_num_rows($imagen_result) != 0){
            return true;
        }
       
        return false;
    }

    /**
     * Función para obtener el listado de subastas vencidas
     */
    function getSubastasVencidas(){
        global $con;
        $arr_subastas = [];
        $fecha = new DateTime();
        $fecha =  $fecha -> format('Y-m-d H:i:s');
        $sub_sql = SQL_ID_NOMBRE_ITEMS_BY_FECHAFIN." < '$fecha'";
        $sub_result = mysqli_query($con, $sub_sql);
        while($sub_row = mysqli_fetch_assoc($sub_result)){
            $id_item = $sub_row['id'];
            $nom_item = $sub_row['nombre'];
            $arr_subastas[$id_item] = $nom_item;
        }
        return $arr_subastas;
    }

     /**
     * Función para obtener el valor maximo de la puja
     */
    function getPujaMaxima($id_item){
        global $con;
        $puja_sql = SQL_IDUSER_CATIDAD_PUJAS_BY_IDITEM." $id_item and cantidad = (".SQL_MAX_CANTIDAD_PUJAS_BY_IDITEM." $id_item);";
        $puja_result = mysqli_query($con, $puja_sql);
        $id_user_puja_max = null;
        while($puja_row = mysqli_fetch_assoc($puja_result)){
            $id_user_puja_max = $puja_row['id_user'];
        }
        return $id_user_puja_max;
    }

     /**
     * Función para obtener pujas en base a un id de item
     */
    function obtenerPujas($id_item){
        global $con;
        $arr_pujas = [];
        $count_pujas_sql = SQL_ID_PUJAS_BY_ID_ITEM." $id_item";
        $pujas_result = mysqli_query($con, $count_pujas_sql);
        while($pujas_row = mysqli_fetch_assoc($pujas_result)){
            array_push($arr_pujas, $pujas_row['id']);
        }
        return $arr_pujas;
    }

     /**
     * Función para eliminar pujas segun el id de puja
     */
    function eliminarPujas($id_puja){
        global $con;
        $eliminar_sql = SQL_DELETE_PUJAS_BY_ID."'$id_puja';";
        mysqli_query($con, $eliminar_sql);
    }

     /**
     * Función para eliminar items en base al id de item
     */
    function eliminarItem($id_item){
        // imagenes y pujas tienen clave ajena que apunta a la primaria de items
        // por ello tenemos que eliminar antes las imagenes y las pujas
        global $con;
        // imagenes
        $arr_img = obtenerImagenes($id_item);
        foreach($arr_img as $img){
            $img = substr($img, 4);
            eliminarImagenBBDD($img);
            eliminarImagenLocal($img);
        }
        // pujas
        $arr_pujas = obtenerPujas($id_item);
        foreach($arr_pujas as $puja){
            eliminarPujas($puja);
        }
        // por último el item
        $eliminar_sql = SQL_DELETE_ITEMS_BY_ID."'$id_item'";
        mysqli_query($con, $eliminar_sql);
    }

    /**
     * Función para listado todos items
     */
    function obtenerTodosItems(){
        global $con;
        $arr_items = [];
        $items_result = mysqli_query($con, SQL_ID_ITEMS);
        while($items_row = mysqli_fetch_assoc($items_result)){
            $id_item = $items_row['id'];
            array_push($arr_items, $id_item);
        }
        return $arr_items;
    }

    /**
     * Función para obtener el listado de subastas a punto de vencer
     */
    function getSubastasAPuntoVencer(){
        global $con;
        $arr_subastas = [];
        $fecha = new DateTime();
        $fechaActual= new DateTime(); 
        $fechaMas3 = $fecha -> modify("+ 3 day");
        $fechaMas3 =  $fechaMas3 -> format('Y-m-d H:i:s');
        $fechaActual = $fechaActual -> format('Y-m-d H:i:s');
        $sub_sql = <<<sql
        select id, nombre from items        
        where date_format(items.fechafin, '%d-%m-%Y') between date_format('$fechaActual','%d-%m-%Y') AND date_format('$fechaMas3',"%d-%m-%Y")
        sql;
        //SQL_ID_NOMBRE_ITEMS_BY_BETWEEN_FCHAFIN. "'$fecha' AND '$fechaMas3'";
        $sub_result = mysqli_query($con, $sub_sql);
        while($sub_row = mysqli_fetch_assoc($sub_result)){
            $id_item = $sub_row['id'];
            $nombre = $sub_row['nombre'];
            $arr_subastas[$id_item] = $nombre;
        }
        return $arr_subastas;
    }

    /**
     * Función para obtener el precio de un item en base al id de item
     */
    function getPrecioItem($id_item){
        global $con;
        $precio_sql = SQL_PRECIOPATIDA_ITEMS_BY_ID."$id_item;";
        $precio_result = mysqli_query($con, $precio_sql);
        while($precio_row = mysqli_fetch_assoc($precio_result)){
            $precio = $precio_row['preciopartida'];
        }
        return $precio;
    }

    /**
     * Función para lobtener la fecha y hora de vencimiento de un item en base a su id
     */
    function getFechaVencimiento($id_item){
        global $con;
        $vence_sql = SQL_FECHAFIN_ITEMS_BY_ID." $id_item;";
        $vence_result = mysqli_query($con, $vence_sql);
        while($vence_row = mysqli_fetch_assoc($vence_result)){
            $f_fin = $vence_row['fechafin'];
        }
        $hoy = new DateTime();
        $fecha_fin = new DateTime($f_fin);
        $intervalo = $fecha_fin -> diff($hoy);
        $intervalo = $intervalo -> format('%d %h');
        $arr_vence = explode(" ", $intervalo);
        $arr_tiempo = [];
        foreach($arr_vence as $ven){
            if($ven != 0){
                array_push($arr_tiempo, $ven);
            }
        }

        $d = "dias";
        $h = "horas";
        if(count($arr_tiempo) == 2){
            if($arr_tiempo[0] == 1) $d = "dia";
            if($arr_tiempo[1] == 1) $h = "hora";
            $vence = $arr_tiempo[0] . " " . $d . " " . $arr_tiempo[1] . " " . $h;
        }
        else{
            if($arr_tiempo[0] == 1) $h = "hora";
            $vence = $arr_tiempo[0] . " " . $h;
        }
        return $vence;
    }

    function sigueSubastaEnActivo($fecha){

        $strFechaFin=strtotime($fecha);
        $strFechaActual=strtotime(date("d-m-Y H:i:00",time()));

        if($strFechaFin >  $strFechaActual)
            return true;
        else
            return false;

    }

    ?>
