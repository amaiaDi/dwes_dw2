<?php 
/* FICHERO DE GESTION
 */
// CONEXION - metodo que crea conexión de BD y la devuelve
function fncCrearConexion( $host, $user, $pass, $db){

    $conn = new mysqli($host,$user, $pass);   
    if(!$conn->select_db($db)) die ($conn->error);  

    return $conn;
}

// CERRAR CONEXION - metodo que desconecta la conexión de BD, devuelve true si ha ido bien o false si no
function fncEliminarConexion($conn){
    return $conn->close();
 }

// BORRAR TABLA - metodo que elimina la tabla si existe y la crea nueva 
function fncBorrarTabla($conn, $tabla){

    //Si la tabla existe la borramos para crearla desde 0
    $queryDropIfExists="DROP table IF EXISTS $tabla"; 
   
    $conn->query($queryDropIfExists);  
   
    if($conn->errno){
        die($conn->error);
    }
}


// CREAR TABLA - metodo que elimina la tabla si existe y la crea nueva 
function fncBorrarYCrearTabla($conn, $tabla, $queryCreateTable){

    global $mensajeUsuario;
    //Si la tabla existe la borramos para crearla desde 0
    $queryDropIfExists="DROP table IF EXISTS $tabla"; 
    $conn->query($queryDropIfExists);  
    if($conn->errno){
        $mensajeUsuario="Error en la conexión con la base de datos";
        die($conn->error);
    }else{

        $conn->query($queryCreateTable);   
 
        if($conn->errno){
            $mensajeUsuario="Error en la conexión con la base de datos";
            die($conn->error);
        }else{
            $mensajeUsuario="Tabla $tabla creada correctamente";
        }
    }  
}
// CREAR TABLA - metodo que elimina la tabla si existe y la crea nueva 
function fncCrearTabla($conn, $queryCreateTable){

    global $mensajeUsuario;

    $conn->query($queryCreateTable);   

    if($conn->errno){
        $mensajeUsuario="Error en la conexión con la base de datos";
        die($conn->error);
    }else{
        $mensajeUsuario="Tabla $tabla creada correctamente";
    } 
}

//SELECT - Metodo generico para consulta de querys sin con variables incluidas en la consulta
function fncConsultarTabla($conn,$sql){

    $resultado = $conn->query($sql);  
   
    if($conn->errno) {
        die($conn->error);
    }else{
        return $resultado;
    }; 
}

// INSERT/UPDATE/DELETE TABLA - metodo que inserta, modifica o elimina datos de la BD
function fncInsertarModificarTabla($conn, $sql){
    $conn->query($sql);  
    if($conn->errno){
        die($conn->error);
    }else{
        $filasAfectadas=0;
        if($conn->affected_rows>0) {
            $filasAfectadas=$conn->affected_rows;
            return $filasAfectadas;
        }

        return $filasAfectadas;
    }
}
//Función que permite consultar querys con 1 bind variable
function fncConsultarTablaCon1BindVariable($conn,$sql, $arrayBindVariable,$tipo){

    $sentencia=$conn->prepare($sql);
  
    $sentencia-> bind_param( $tipo, $arrayBindVariable[0]);

    $sentencia->execute();

    $resultado=$sentencia->get_result();

    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 
}
//Función que permite consultar querys con 2 bind variable
function fncConsultarTablaCon2BindVariables($conn,$sql, $arrayBindVariable,$tipo){

    $sentencia=$conn->prepare($sql);
  
    $sentencia-> bind_param( $tipo, $arrayBindVariable[0],$arrayBindVariable[2]);

    $sentencia->execute();

    $resultado=$sentencia->get_result();

    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 
}
//
?>