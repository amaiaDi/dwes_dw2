<?php
// datos BBDD
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_DATABASE = "subastas";

// datos aplicación
const CARPETA_IMAGENES = "img";
const TITULO_SUBASTAS = "SUBASTAS DWES";
const RUTA_APLICACION = "index.php";
const TIPO_MONEDA = "€";
const USUARIO_ADMIN="admin";

//titulos
const TITULO_IMAGEN="IMAGEN";
const TITULO_ITEM="ÍTEM";
const TITULO_PUJAS="PUJAS";
const TITULO_PRECIO="PRECIO";
const TITULO_PUJAS_HASTA="PUJASHASTA";
const TITULO_ITEMS_DISPONIBLE="Items disponibles";
const TITULO_EDITAR_ITEM="Editar Item";
const TITULO_NOMBRE_ITEM="Nombre item";

//textos
const TEXTO_NO_IMAGEN="NO_IMAGEN";
const TEXTO_PRECIO_SALIDA="Precio de salida";
const TEXTO_BAJAR="BAJAR";
const TEXTO_SUBIR="SUBIR";
const TEXTO_FECHA_FIN_PARA_PUJAR="Fecha fin para pujar";
const TEXTO_IMAGENES_ACTUALES="Imagenes actuales";

//CONSULTAS SQL
const SQL_TODAS_CATEGORIAS = "SELECT * FROM CATEGORIAS ORDER BY categoria ASC";
const SQL_TODOS_ITEMS_DISPONIBLES= "select items.id, imagenes.imagen, items.nombre, items.preciopartida, items.fechafin
from items
left join imagenes on imagenes.id_item=items.id
and imagenes.id = (select min(id) from imagenes where id_item = items.id)";
const SQL_REGISTRO_EMAIL="select email, cadenaverificacion
from usuarios where email = ";

?>