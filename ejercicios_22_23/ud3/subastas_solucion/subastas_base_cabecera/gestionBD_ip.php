<?php
/* 
 * METODOS GENERICOS DE BD CON INTERFAZ PROCEDIMENTAL
 */
// CONEXION - metodo que crea conexión de BD y la devuelve
function fncCrearConexion($host, $user, $pass, $db){

   $con = mysqli_connect($host,$user, $pass);
   mysqli_select_db($con, $db);

   return $con;
}

// CERRAR CONEXION - metodo que desconecta la conexión de BD, devuelve true si ha ido bien o false si no
function fncEliminarConexion($con){
    return mysqli_close(con);
 }

// BORRAR TABLA - metodo que elimina la tabla si existe y la crea nueva 
function fncBorrarTabla($conn, $tabla){

    //Si la tabla existe la borramos para crearla desde 0
    $queryDropIfExists="DROP table IF EXISTS $tabla"; 
   
    mysqli_query($conn, $queryDropIfExists);  
   
    if(mysqli_errno($conn)) die(mysqli_error($conn));  
}


// CREAR TABLA - metodo que elimina la tabla si existe y la crea nueva 
function fncBorrarYCrearTabla($conn, $tabla, $queryCreateTable){

    global $mensajeUsuario;
    //Si la tabla existe la borramos para crearla desde 0
    $queryDropIfExists="DROP table IF EXISTS $tabla"; 
    mysqli_query($conn, $queryDropIfExists);   

    if(mysqli_errno($conn)){ 
        $mensajeUsuario="Error en la conexión con la base de datos";
        die(mysqli_error($conn));
    }else{

        $resultado = mysqli_query($conn, $queryCreateTable);  
        if(mysqli_errno($conn)){
            $mensajeUsuario="Error en la conexión con la base de datos";
            die(mysqli_error($conn));   
        }else{
            $mensajeUsuario="Tabla $tabla creada correctamente";
        }
    }  
}
// CREAR TABLA - metodo que elimina la tabla si existe y la crea nueva 
function fncCrearTabla($conn, $queryCreateTable){

    global $mensajeUsuario;

    $resultado = mysqli_query($conn, $queryCreateTable);  
    if(mysqli_errno($conn)){
        $mensajeUsuario="Error en la conexión con la base de datos";
        die(mysqli_error($conn));   
    }else{
        $mensajeUsuario="Tabla $tabla creada correctamente";
    }
}

//SELECT - Metodo generico para consulta de querys sin con variables incluidas en la consulta
function fncConsultarTabla($conn,$sql){

    $resultado= mysqli_query($conn,$sql);
    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 
}

//SELECT BIND VARIABLES Metodo generico para consulta de querys con 1 bind variable 
function fncConsultarTablaCon1BindVariable($conn,$sql, $arrayBindVariables,$tipo){

    $sentencia=mysqli_prepare($conn,$sql);
  
    mysqli_stmt_bind_param($sentencia, $tipo, $arrayBindVariables[0]);

    mysqli_stmt_execute($sentencia);

    $resultado=mysqli_stmt_get_result($sentencia);

    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 
}
//SELECT BIND VARIABLES Metodo generico para consulta de querys con 2 binds variables 
function fncConsultarTablaCon2BindVariables($conn,$sql, $arrayBindVariables,$tipo){

    $sentencia=mysqli_prepare($conn,$sql);
  
    mysqli_stmt_bind_param($sentencia, $tipo, $arrayBindVariables[0], $arrayBindVariables[1]);

    mysqli_stmt_execute($sentencia);

    $resultado=mysqli_stmt_get_result($sentencia);

    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 
}

// INSERT/UPDATE/DELETE TABLA - metodo que inserta, modifica o elimina datos de la BD
function fncInsertarModificarTabla($conn, $sql){

    mysqli_query($conn, $sql);  
   
    if(mysqli_errno($conn)){  
        die(mysqli_error($conn));
    }else{
        $filasAfectadas=0;
        if(mysqli_affected_rows($conn)>0) {
            return $filasAfectadas;
        }

        return $filasAfectadas;
    }
}
?>
<?php
