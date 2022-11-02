<?php
    /*
    * CONSTANTES INFORMACION BD
    */

    const DB_HOST="localhost";
    const DB_USER="root";
    const DB_PASS="";
    const DB_DATABASE="restaurante";
    const DB_TABLA_ALIMENTO="alimentos";
    const DB_TABLA_CLIENTES="clientes";
    const DB_TABLA_PEDIDOS="pedidos";

    /*
    * CONSTANTES ERRORES
    */
    const ERROR_NOMBRE_ALIMENTO="El campo de Nombre no contiene información obligatoria para insertar registro";
    const ERROR_TIPO_ALIMENTO="El campo de Tipo no contiene información obligatoria para insertar registro";
    const ERROR_FECHA_ALIMENTO="El campo de Fecha no contiene información obligatoria para insertar registro";
    const ERROR_PRECIO_ALIMENTO="El campo de Precio no contiene información obligatoria para insertar registro";
    const ERROR_SELECCION_IMAGEN="Es necesario seleccionar un alimento para añadirle la imagen";
    const ERROR_IMAGEN_NO_ADECUADA="La imagen no es adecuada y no ha podido ser guardada";
    const ERROR_GUARDADO_IMAGEN="Error al guardar la imagen";
    const ERROR_SIN_IMAGEN="No hay imagen para mostrar";

    /*
    * CONSTANTES RUTAS
    */
    const RUTA_CREARBD="crearBd.php";
    const RUTA_INDEX_IP="index_ip.php";
    const RUTA_INDEX_IOO="index_ioo.php";
    const RUTA_PEDIDOS_IP="pedir_ip.php";
    const RUTA_PEDIDOS_IOO="pedir_ioo.php";

    /*
    * CONSTANTES QUERYS SQL
    */
    const SQL_BUSCAR_ALIMENTOS_TIPO_BIND=<<<EOT
    SELECT * FROM ALIMENTOS WHERE tipo=?
    EOT;
    const SQL_BUSCAR_ALIMENTOS=<<<EOT
    SELECT * FROM alimentos ORDER BY alimentos.tipo,alimentos.nombre
    EOT;
    const SQL_BUSCAR_CLIENTES=<<<EOT
    SELECT clientes.nombre FROM clientes ORDER BY clientes.nombre
    EOT;
    const SQL_BUSCAR_PEDIDOS=<<<EOT
    SELECT * FROM pedidos
    EOT;
    const SQL_CREATE_TABLE_ALIMENTOS=<<<EOT
        CREATE TABLE ALIMENTOS ( id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NULL,
        precio FLOAT NULL,
        tipo VARCHAR(45) NULL,
        fecha DATE NULL, 
        PRIMARY KEY (id))
    EOT;
    const SQL_CREATE_TABLE_CLIENTES=<<<EOT
        CREATE TABLE CLIENTES ( id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NULL, 
        PRIMARY KEY (id))
    EOT;
    const SQL_CREATE_TABLE_PEDIDOS=<<<EOT
        CREATE TABLE PEDIDOS ( id INT NOT NULL AUTO_INCREMENT,
        id_cliente INT NOT NULL,
        preciototal FLOAT NULL,
        PRIMARY KEY (id))
    EOT;
    const SQL_BUSCAR_ALIMENTOS_MENOR_MEDIA=<<<EOT
    SELECT nombre, precio, tipo, fecha FROM ALIMENTOS
    WHERE precio < (select AVG(precio) from ALIMENTOS)
    EOT;
    const SQL_UPDATE_IMAGEN_ALIMENTO_BIND=<<<EOT
    UPDATE alimentos SET fichero=? WHERE id=?
    EOT;
    const SQL_UPDATE_PRECIO_ALIMENTOS=<<<EOT
    UPDATE alimentos SET precio=
    EOT;
    const SQL_UPDATE_PRECIO_ALIMENTO_BIND=<<<EOT
    UPDATE alimentos SET precio=?
    EOT;
    const SQL_BUSCAR_ALIMENTO_LIKE_NOMBRE_BIND=<<<EOT
    SELECT * FROM alimentos WHERE NOMBRE LIKE '%?%'
    EOT;
    const SQL_BUSCAR_ALIMENTO_LIKE_NOMBRE=<<<EOT
    SELECT * FROM alimentos WHERE NOMBRE LIKE
    EOT;

    /*
    / VARIABLES GLOBALES
    */

    //PANTALLA CREAR BD
    // Variables para mostrar mensajes por pantalla
    $mensajeUsuario="";
    $errorNombreAlimento="";
    $errorTipoAlimento="";
    $errorPrecioAlimento="";
    $mensajeAlimentosPorTipo="";
    $mensajeErrorImagen="";

    //Campos a rellenar en pantalla
    $nombreAlimento="";
    $precioAlimento="";
    $tipoAlimento="";
    $consultaTipoAlimento="";
    $porcentajePrecio="";
    $nombreAlimento="";
    ?>