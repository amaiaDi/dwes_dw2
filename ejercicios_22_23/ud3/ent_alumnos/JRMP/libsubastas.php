<?php
    include_once("config.php");
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
    mysqli_select_db($con, DB_DATABASE);

    function crearCadenaVerificacion(){
        $randomstring="";
        for($i = 0; $i < 16; $i++) {
            $randomstring .= chr(mt_rand(32,126));
        }
        return $randomstring;
    }

    
    function comprobarMail($mail, $cadena_verif){
        global $con;
        $mail_sql = "select email, cadenaverificacion
        from usuarios where email = '$mail'";
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

    function idUsuarioEmail($mail){
        global $con;
        $mail_sql = "select id from usuarios where email = '$mail'";
        $mail_result = mysqli_query($con, $mail_sql);
        while($mail_row = mysqli_fetch_assoc($mail_result)){
            $id = $mail_row['id'];
        }
        return $id;
    }

    function darUsuarioAlta($id_user){
        global $con;
        $mail_sql = "update usuarios set activo = '1' where id = $id_user";
        mysqli_query($con, $mail_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    function insertarUsuario($usuario, $nombre, $pass, $email, $cadena){
        global $con;
        $insert_sql = "INSERT INTO usuarios (id, username, nombre, password, email, cadenaverificacion, activo, falso) VALUES (NULL, '$usuario', '$nombre', '$pass', '$email', '$cadena', '0', '1');";
        mysqli_query($con, $insert_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    function usuarioExiste($usuario){
        global $con;
        $buscar_sql = "SELECT username FROM usuarios;";
        $buscar_result = mysqli_query($con, $buscar_sql);
        while($buscar_row = mysqli_fetch_assoc($buscar_result)){
            if($buscar_row['username'] == $usuario){
                return true;
            }
        }
        return false;
    }

    // devuelve 1: usuario y contraseña correctos, usuario verificado
    //          2: usuario y contraseña correctos, usuario NO verificado
    //          3: usuario o contraseña incorrectos
    function comprobarLogin($usuario, $password){
        global $con;
        $comprobar_sql = "SELECT username, password, activo FROM usuarios;";
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


    function obtenerCategorias(){
        global $con;
        $categorias = [];
        $cat_sql = "SELECT * FROM CATEGORIAS ORDER BY categoria ASC;";
        $cat_result = mysqli_query($con,$cat_sql);
        while($cat_row = mysqli_fetch_assoc($cat_result)) {
            array_push($categorias, ucfirst($cat_row['categoria']));
        }
        return $categorias;
    }

    function cantidadPujas($item_id){
        global $con;
        $count_pujas_sql = "
        select count(pujas.id) cuenta
        from pujas
        where id_item = $item_id;";
        $pujas_result = mysqli_query($con, $count_pujas_sql);
        while($pujas_row = mysqli_fetch_assoc($pujas_result)){
            $cuenta = $pujas_row['cuenta'];
        }
        return $cuenta;
    }

    function precioMaximo($item_id){
        global $con;
        $precio_sql = "select preciopartida from items  where id = $item_id";
        $precio_result = mysqli_query($con, $precio_sql);
        while($precio_row = mysqli_fetch_assoc($precio_result)){
            $precio_item = $precio_row['preciopartida'];
        }

        $precio_max_sql = "
                select max(cantidad) cant
                from pujas
                where pujas.id_item = $item_id;
            ";
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

    function fechaFinPuja($item_id){
        global $con;
        $fecha_sql = "select fechafin from items  where id = $item_id";
        $fecha_result = mysqli_query($con, $fecha_sql);
        while($fecha_row = mysqli_fetch_assoc($fecha_result)){
            $fecha = $fecha_row['fechafin'];
        }
        return $fecha;
    }


    function obtenerImagenes($item_id){
        global $con;
        $img_sql = "select imagen from imagenes where id_item = $item_id";
        $img_result = mysqli_query($con, $img_sql);
        $arr_img = [];
        while($img_row = mysqli_fetch_assoc($img_result)){
            $img = $img_row['imagen'];
            array_push($arr_img, CARPETA_IMAGENES . "/" . $img);
        }
        return $arr_img;
    }

    function obtenerDescripcion($item_id){
        global $con;
        $desc_sql = "select descripcion from items where id = $item_id";
        $desc_result = mysqli_query($con, $desc_sql);
        while($desc_row = mysqli_fetch_assoc($desc_result)){
            $desc = $desc_row['descripcion'];
        }
        return $desc;
    }

    function obtenerHistorial($item_id){
        global $con;
        $historial = [];
        $histo_sql = "
        select username, cantidad 
        from pujas
        inner join usuarios on usuarios.id = id_user
        where id_item = $item_id order by cantidad desc;
        ";
        $histo_result = mysqli_query($con, $histo_sql);
        while($histo_row = mysqli_fetch_assoc($histo_result)){
            $moneda = TIPO_MONEDA;
            $linea = ucfirst($histo_row['username']) . " - " . $histo_row['cantidad'] . $moneda;
            array_push($historial, $linea);
        }
        return $historial;
    }

    function idUsuario($nombre){
        global $con;
        $usu_sql = "select id from usuarios where username = '$nombre';";
        $usu_result = mysqli_query($con, $usu_sql);
        while($usu_row = mysqli_fetch_assoc($usu_result)){
            $id = $usu_row['id'];
        }
        return $id;
    }

    function nombreUsuario($id_usuario){
        global $con;
        $usu_sql = "select nombre from usuarios where id = '$id_usuario';";
        $usu_result = mysqli_query($con, $usu_sql);
        while($usu_row = mysqli_fetch_assoc($usu_result)){
            $nombre = $usu_row['nombre'];
        }
        return $nombre;
    }

    function idCategoria($nombre){
        global $con;
        $nombre = strtolower($nombre);
        $cat_sql = "select id from categorias where categoria = '$nombre';";
        $cat_result = mysqli_query($con, $cat_sql);
        while($cat_row = mysqli_fetch_assoc($cat_result)){
            $id = $cat_row['id'];
        }
        return $id;
    }

    function idItem($nombre){
        global $con;
        $item_sql = "select id from items where nombre = '$nombre';";
        $item_result = mysqli_query($con, $item_sql);
        while($item_row = mysqli_fetch_assoc($item_result)){
            $id = $item_row['id'];
        }
        return $id;
    }

    function nombreItem($id){
        global $con;
        $item_sql = "select nombre from items where id = '$id';";
        $item_result = mysqli_query($con, $item_sql);
        while($item_row = mysqli_fetch_assoc($item_result)){
            $nombre = $item_row['nombre'];
        }
        return $nombre;
    }
    
    function insertarPuja($id_item, $usuario, $cantidad){
        global $con;
        $id_user = idUsuario($usuario);
        $fecha = date("Y-m-d");
        $insert_sql = "INSERT INTO pujas 
        (id, id_item, id_user, cantidad, fecha) 
        VALUES (NULL, '$id_item', '$id_user', '$cantidad', '$fecha');";
        mysqli_query($con, $insert_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    function pujasUsuario($id_item, $usuario){
        global $con;
        $id_user = idUsuario($usuario);
        $contar_sql = "select count(id)
                        from pujas
                        where id_item = '$id_item'
                        and id_user = '$id_user'
                        and fecha = date_format(sysdate(),'%Y-%m-%d');";
        $contar_result = mysqli_query($con, $contar_sql);
        while($contar_row = mysqli_fetch_assoc($contar_result)){
            $contar = $contar_row['count(id)'];
        }
        if(mysqli_errno($con)) die(mysqli_error($con)); 
        return $contar;
    }


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

    function verificarNuevoItem($nombre, $descripcion, $precio, $fecha){
        $mensaje_error = "";
        if($fecha < time()) $mensaje_error .= "<p>* Fecha incorrecta</p>";
        if(empty($nombre)) $mensaje_error .= "<p>* El campo nombre no puede estar vacío</p>";
        if(empty($descripcion)) $mensaje_error .= "<p>* El campo descripcion no puede estar vacío</p>";
        if(empty($precio)) $mensaje_error .= "<p>* El campo precio no puede estar vacío</p>";
        if(!is_numeric($precio)) $mensaje_error .= "<p>* El precio debe ser un número</p>";
        return $mensaje_error;
    }

    function insertarItem($id_categoria, $id_usuario, $nombre, $precio, $descripcion, $fecha){
        global $con;
        $insertar_sql = "INSERT INTO items 
                         (id, id_cat, id_user, nombre, preciopartida, descripcion, fechafin) 
                         VALUES (NULL, '$id_categoria', '$id_usuario', '$nombre', '$precio', 
                         '$descripcion', '$fecha');";
        mysqli_query($con, $insertar_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    function esDuenio($usuario, $id_item){
        global $con;
        $id_usuario = idUsuario($usuario);
        $duenio_sql = "select count(id) 
                        from items 
                        where id_user = '$id_usuario'
                        and id = $id_item;";
        $duenio_result = mysqli_query($con, $duenio_sql);
        while($duenio_row = mysqli_fetch_assoc($duenio_result)){
            $cont = $duenio_row['count(id)'];
            if($cont == 1){
                return true;
            }
        }
        return false;
    }

    function modificarPrecio($id_item, $cantidad, $precio_anterior, $tipo){
        global $con;
        if($tipo == "bajar") $nuevo_precio = $precio_anterior - $cantidad ;
        elseif ($tipo == "subir") $nuevo_precio = $precio_anterior + $cantidad ;
        $modif_sql = "UPDATE items SET preciopartida = $nuevo_precio WHERE items.id = $id_item";
        mysqli_query($con, $modif_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }

    function posponer($tiempo, $id_item){
        global $con;
        $fecha = fechaFinPuja($id_item);
        $fecha = new DateTime($fecha);
        $fecha -> modify("+ 1 $tiempo");
        $nueva_fecha = $fecha -> format('Y-m-d H:i:s');
        $posp_sql = "update items set fechafin = '$nueva_fecha' where id = $id_item;";
        mysqli_query($con, $posp_sql);
    }

    
    function nombreImagen($nombre_img, $id_item){
        global $con;
        $partir_nombre = explode(".", $nombre_img);
        $nombre = $partir_nombre[0];
        $extension = $partir_nombre[1];
        $arr_nombres = [];
        $imagen_sql = "select imagen from imagenes where imagen like '$nombre%.$extension'
        and id_item = $id_item;";
        $imagen_result = mysqli_query($con, $imagen_sql);
        while($imagen_row = mysqli_fetch_assoc($imagen_result)){
            $nombre_parecido = $imagen_row['imagen'];
            array_push($arr_nombres, $nombre_parecido);
        }
        if(count($arr_nombres) == 0){
            $nombre_final = $nombre_img;
        }
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
    
    function insertarImagen($id_item, $nombre_imagen){
        global $con;
        $ins_img_sql = "insert into imagenes values (null, $id_item, '$nombre_imagen');";
        $ins_img_result = mysqli_query($con, $ins_img_sql);
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    }
    
    
    function eliminarImagenBBDD($ruta){
        global $con;
        $eliminar_sql = "DELETE FROM imagenes WHERE imagen = '$ruta';";
        mysqli_query($con, $eliminar_sql);
    }

    function eliminarImagenLocal($ruta){
        $ruta_completa = "img/" . $ruta;
        unlink($ruta_completa);
    }


    function subastasVencidas(){
        global $con;
        $arr_subastas = [];
        $fecha = new DateTime();
        $fecha =  $fecha -> format('Y-m-d H:i:s');
        $sub_sql = "select id, nombre from items where fechafin < '$fecha'";
        $sub_result = mysqli_query($con, $sub_sql);
        while($sub_row = mysqli_fetch_assoc($sub_result)){
            $id_item = $sub_row['id'];
            $nom_item = $sub_row['nombre'];
            $arr_subastas[$id_item] = $nom_item;
        }
        return $arr_subastas;
    }

    function pujaMaxima($id_item){
        global $con;
        $puja_sql = "select id_user, cantidad
                     from pujas
                     where id_item = $id_item
                     and cantidad = (select max(cantidad) from pujas where id_item = $id_item);";
        $puja_result = mysqli_query($con, $puja_sql);
        $id_user_puja_max = null;
        while($puja_row = mysqli_fetch_assoc($puja_result)){
            $id_user_puja_max = $puja_row['id_user'];
        }
        return $id_user_puja_max;
    }

    function obtenerPujas($item_id){
        global $con;
        $arr_pujas = [];
        $count_pujas_sql = "
        select id
        from pujas
        where id_item = $item_id;";
        $pujas_result = mysqli_query($con, $count_pujas_sql);
        while($pujas_row = mysqli_fetch_assoc($pujas_result)){
            array_push($arr_pujas, $pujas_row['id']);
        }
        return $arr_pujas;
    }

    function eliminarPujas($id_puja){
        global $con;
        $eliminar_sql = "DELETE FROM pujas WHERE id = '$id_puja';";
        mysqli_query($con, $eliminar_sql);
    }

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
        $eliminar_sql = "DELETE FROM items WHERE id = '$id_item';";
        mysqli_query($con, $eliminar_sql);
    }

    function obtenerTodosItems(){
        global $con;
        $arr_items = [];
        $items_sql ="select id from items;";
        $items_result = mysqli_query($con, $items_sql);
        while($items_row = mysqli_fetch_assoc($items_result)){
            $id_item = $items_row['id'];
            array_push($arr_items, $id_item);
        }
        return $arr_items;
    }

    function subastasAPuntoVencer(){
        global $con;
        $arr_subastas = [];
        $fecha = new DateTime();
        $fecha = $fecha -> modify("+ 3 day");
        $fecha =  $fecha -> format('Y-m-d H:i:s');
        $sub_sql = "select id, nombre from items where fechafin between sysdate() and '$fecha'";
        $sub_result = mysqli_query($con, $sub_sql);
        while($sub_row = mysqli_fetch_assoc($sub_result)){
            $id_item = $sub_row['id'];
            $nombre = $sub_row['nombre'];
            $arr_subastas[$id_item] = $nombre;
        }
        return $arr_subastas;
    }

    function precioItem($id_item){
        global $con;
        $precio_sql = "select preciopartida from items where id=$id_item;";
        $precio_result = mysqli_query($con, $precio_sql);
        while($precio_row = mysqli_fetch_assoc($precio_result)){
            $precio = $precio_row['preciopartida'];
        }
        return $precio;
    }

    function venceEn($id_item){
        global $con;
        $vence_sql = "select fechafin from items where id = $id_item;";
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


    ?>
