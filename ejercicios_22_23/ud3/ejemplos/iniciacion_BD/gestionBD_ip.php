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
/*
*   METODOS ESPECIFICOS DE BD RESTAURANTE - INTERFAZ PROCEDIMENTAL
*/

//Guardar fichero BLOB en la fila de la tabla especificada en la consulta
function fncGuardarFicheroBLOB($conn, $sql, $arrayDatosFichero, $id){

    //obtenemos la información del fichero a guarda en BD
    $fichero = $arrayDatosFichero['cargaFichero']['tmp_name'];
    $ficheroContenido = addslashes(file_get_contents($fichero));

    $sql="UPDATE alimentos SET fichero='".$ficheroContenido."' WHERE id=".$id;
    $resultado = mysqli_query($con, $sql);  
    
    if(mysqli_errno($con)) die(mysqli_error($con));  

}
// INSERTAR ALIMENTO NUEVO
// -	Nombre (caja de texto) + precio (caja de texto) + select (con primero, segundo, postre) +submit  Para insertar nuevo alimento en la tabla con la fecha de hoy
function fncInsertarNuevoAlimento($conn,$tabla, $arrayInfoAlimento){

    $nombre=$arrayInfoAlimento['nombreAlimento'];
    $precio=(float)$arrayInfoAlimento['precioAlimento'];
    $tipo= $arrayInfoAlimento['tipoAlimento'];
    //$fecha=$arrayInfoAlimento['fechaAlimento'];
    
    $sql = "INSERT INTO $tabla (nombre, precio, tipo, fecha) VALUES ('$nombre',$precio,'$tipo',SYSDATE())"; 
    $resultado = mysqli_query($conn, $sql);  
    if(mysqli_errno($conn)) die(mysqli_error($conn));  

}
// ACTUALIZAR CAMPO FECHA
// -	Submit  Para actualizar todos los alimentos de la tabla con “fecha anterior al 1 de Enero de 2014” y ponerles la fecha de hoy
function fncActualizarCampoFecha($conn,$nobreTabla){

    $sql = "UPDATE $nobreTabla SET fecha=SYSDATE() WHERE fecha < '2014-01-01'";  
    $resultado = mysqli_query($conn, $sql);  
    if(mysqli_errno($conn)) die(mysqli_error($conn)); 

}
// CONSULTA DE ALIMENTOS BARATOS
// -	Submit  Para visualizar una tabla html con los 
// alimentos de precio menor al precio medio: Usando mysqli_fetch_assoc
function fncConsultaAlimentosBaratos($conn){

    $resultado= mysqli_query($conn,SQL_ALIMENTOS_MENOR_MEDIA);
    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 


}
// CONSULTA DE ALIMENTOS POR TIPO
// -	3 radios (primero, segundo, postre) + submit  Para visualizar una lista html con los alimentos del tipo seleccionado: Usando mysqli_fetch_array
function fncConsultaAlimentosPorTipo($conn,$nobreTabla,$tipo){

    $sql = "SELECT nombre, precio, tipo, fecha FROM $nobreTabla 
    WHERE tipo='$tipo'";

    $resultado= mysqli_fetch_assoc($conn,$sql);
    if(mysqli_errno($conn)) {
        die(mysqli_error($conn));
    }else{
        return $resultado;
    }; 
}
?>