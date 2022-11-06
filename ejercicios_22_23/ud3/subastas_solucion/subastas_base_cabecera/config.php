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
const SQL_ID_USUARIO_BY_EMAIL="select id from usuarios where email = ";
const SQL_UPDATE_USUARIO_ACTIVO_WHERE_ID="update usuarios set activo = '1' where id =";
const SQL_INSERT_USUARIO="INSERT INTO usuarios (id, username, nombre, password, email, cadenaverificacion, activo, falso) VALUES (";
const SQL_DATOS_USUARIO_POR_USERNAME="SELECT * FROM usuarios where username = ";
const SQL_USERNAME_PASSWORD_USUARIOS="SELECT username, password, activo FROM usuarios";
const SQL_TODAS_CATEGORIAS="SELECT * FROM CATEGORIAS ORDER BY categoria ASC";
const SQL_COUNT_PUJAS= "select count(pujas.id) cuenta from pujas where id_item = ";
const SQL_PRECIOPARTIDA_ITEMS="select preciopartida from items  where id = ";
const SQL_MAX_CANTIDAD_PUJA="select max(cantidad) cant from pujas where pujas.id_item =";
const SQL_FECHAFIN_ITEMS="select fechafin from items  where id = ";
const SQL_IMAGEN_BY_ID="select imagen from imagenes where id_item =";
const SQL_DESCRIPCION_ITEMS_BY_ID="select descripcion from items where id =";
const SQL_USERNAME_CANTIDAD_PUJAS_USUARIOS_BY_ID="select username, cantidad from pujasinner 
                                                join usuarios on usuarios.id = id_user where id_item = ";
const SQL_ID_FROM_USUARIOS_BY_USERNAME="select id from usuarios where username =";
const SQL_NOMBRE_FROM_USUARIOS_BY_ID="select nombre from usuarios where id =";
const SQL_ID_CATEGORIAS_BY_CATEGORIA="select id from categorias where categoria = ";
const SQL_ID_ITEMS_BY_NOMBRE="select id from items where nombre = ";
const SQL_NOMBRE_ITEMS_BY_ID="select nombre from items where id = ";
//ORDER
const SQL_ORDERBY_CANTIDAD_DESC=" order by cantidad desc";
?>