<?php
    include_once("config.php");
    $con = mysqli_connect(HOST, USER, PASS);
    mysqli_select_db($con, DATABASE);


function cuantasPujas($id){
    global $con;
    $consultapuj="
                    select count(*) 
                    from pujas
                    where id_item=$id;";
    $resultpuj = mysqli_query($con, $consultapuj);
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        return $item_row['count(*)'];
    }
}
function preciopuja($id){
    global $con;
    $consultapuj="
                    select max(cantidad) 
                    from pujas
                    where id_item=$id;";
    $resultpuj = mysqli_query($con, $consultapuj);
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        return $item_row['max(cantidad)'];
    }
}
function existeUsuario($nombre){
    global $con;
    $consultapuj="
                    select count(*) 
                    from usuarios
                    where username='$nombre';";
    $resultpuj = mysqli_query($con, $consultapuj);
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        return $item_row['count(*)'];
    }
}

function insertarTupla($consulta){
    global $con;
    mysqli_query($con, $consulta);
    if(mysqli_errno($con)) die(mysqli_error($con)); 
}

function cadenaRandom(){
    $cadena="";
    for($i=0;$i<16;$i++) {
        $cadena=$cadena.chr(mt_rand(32,126));
    }
    return $cadena;
}

function existeUsuarioContr($nombre, $contrasenia){
    global $con;
    $consultausr="
                    select count(*) 
                    from usuarios
                    where username='$nombre'
                    and password='$contrasenia';";
    $resultusr = mysqli_query($con, $consultausr);
    while($item_row = mysqli_fetch_assoc($resultusr)){
        return $item_row['count(*)'];
    }
}
function usuarioNoActivo($nombre){
    global $con;
    $consultact="
                    select count(*) 
                    from usuarios
                    where username='$nombre'
                    and activo='0';";
    $resultact = mysqli_query($con, $consultact);
    while($item_row = mysqli_fetch_assoc($resultact)){
        return $item_row['count(*)'];
    }
}
function fechaMaxima($nombre){
    global $con;
    $consultapuj="
                    select fechafin 
                    from items
                    where nombre='$nombre';";
    $resultpuj = mysqli_query($con, $consultapuj);
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        return $item_row['fechafin'];
    }
}
function fotos($id){
    global $con;
    $consultapuj="
                    select imagen 
                    from imagenes
                    where id_item='$id';";
    $resultpuj = mysqli_query($con, $consultapuj);
    $array=array();
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        array_push($array, $item_row['imagen']);
    }
    return $array;
}
function detalles($nombre){
    global $con;
    $consultapuj="
                    select descripcion 
                    from items
                    where nombre='$nombre';";
    $resultpuj = mysqli_query($con, $consultapuj);
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        return $item_row['descripcion'];
    }
}
function pujasHoy($id){
    global $con;
    $consultapuj="
                    select count(*) 
                    from pujas
                    where id_user='$id'
                    and fecha=SYSDATE();";
    $resultpuj = mysqli_query($con, $consultapuj);
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        return $item_row['count(*)'];
    }
}
function deNombreaId($nombre){
    global $con;
    $consultapuj="
                    select id 
                    from usuarios
                    where username='$nombre';";
    $resultpuj = mysqli_query($con, $consultapuj);
    while($item_row = mysqli_fetch_assoc($resultpuj)){
        return $item_row['id'];
    }
}
function nuevaPuja($id, $nombre, $dinero){
    // Me peta no se porque
    // global $con;
    // $idusr=deNombreaId($nombre)
    // $consulta="INSERT INTO pujas VALUES (NULL, '$id', '$idusr','$dinero', SYSDATE())";
    // mysqli_query($con, $consulta);
    // if(mysqli_errno($con)) die(mysqli_error($con)); 
}
?>