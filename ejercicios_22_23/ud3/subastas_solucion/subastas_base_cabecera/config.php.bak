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

//MAIL
const URL_ENVIO_MAIL_VERIFICACION="http://localhost/dwes/ud3%20-%20BBDD/subastas";
const MAIL_FROM="From:dwes.icj@gmail.com";
const MAIL_TITULO= "Registro en SUBASTAS DEWS";

//titulos
const TITULO_IMAGEN="IMAGEN";
const TITULO_ITEM="ÍTEM";
const TITULO_PUJAS="PUJAS";
const TITULO_PRECIO="PRECIO";
const TITULO_PUJAS_HASTA="PUJASHASTA";
const TITULO_ITEMS_DISPONIBLE="Items disponibles";
const TITULO_EDITAR_ITEM="Editar Item";
const TITULO_MENU_SUBASTAS_VENCIDAS="Subastas vencidas";
const TITULO_MENU_ANUNCIANTES="Anunciantes";
const TITULO_MENU_NUEVO_ITEM="Nuevo ítem";
const TITULO_MENU_LOGOUT="Logout";
const TITULO_MENU_LOGIN="Login";
const TITULO_NUEVO_ITEM="Añade nuevo item";
const TITULO_NOMBRE_ITEM="Nombre item";
const TITULO_SUBASTAS_VENCER="Subastas a punto de vencer";
const TITULO_VENCE_EN="VENCE EN";
const TITULO_ANUNCIANTE="ANUNCIANTE";
const TITULO_TIPO="TIPO";

//textos
const TEXTO_NO_IMAGEN="NO IMAGEN";
const TEXTO_PRECIO_SALIDA="Precio de salida";
const TEXTO_BAJAR="BAJAR";
const TEXTO_SUBIR="SUBIR";
const TEXTO_FECHA_FIN_PARA_PUJAR="Fecha fin para pujar";
const TEXTO_IMAGENES_ACTUALES="Imagenes actuales";
const TEXTO_USUARIO_LOGUEADO="Usuario logueado: ";

//Mensajes

const MSJ_VALIDACION_ERROR_FECHA="Fecha incorrecta";
const MSJ_VALIDACION_ERROR_NOMBRE="El campo nombre no puede estar vacío";
const MSJ_VALIDACION_ERROR_DESCRIPCION="El campo descripcion no puede estar vacío";
const MSJ_VALIDACION_ERROR_PRECIO="El campo precio no puede estar vacío";
const MSJ_VALIDACION_ERROR_PRECIO_NUM="El precio debe ser un número";
const MSJ_ITEM_REPETIDO_NOMBRE_CATEGORIA="El nombre del item que intenta introducir en esa categoria ya existe, pruebe con otro";
const MSJ_INFO_PANTALLA_REGISTRO="Para registrarte en SUBASTAS DEWS, rellena el siguiente formulario";
const MSJ_INFO_USUARIO_REGISTRADO=" ha sido registrado correctamente, revise su email de verificación y acceda a la pantalla de login para loguearse.";
const MSJ_ERROR_IMAGEN_DUPLICADA=" Ya existe una imagen con este nombre para este item. Intentelo de nuevo";


//CONSULTAS SQL
const SQL_TODAS_CATEGORIAS = "SELECT * FROM CATEGORIAS ORDER BY categoria ASC";
const SQL_TODOS_ITEMS_DISPONIBLES= "select items.id, imagenes.imagen, items.nombre, items.preciopartida, items.fechafin
from items left join imagenes on imagenes.id_item=items.id and imagenes.id = (select min(id) from imagenes where id_item = items.id)";


const SQL_ID_CATEGORIAS="select id from categorias";
const SQL_ID_ITEMS="select id from items";
const SQL_ID_USUARIO="select id from usuarios";
const SQL_ID_IMAGENES="select id from imagenes";
const SQL_ID_PUJAS="select id from pujas";
const SQL_ID_USUARIO_BY_EMAIL="select id from usuarios where email = ";
const SQL_ID_FROM_USUARIOS_BY_USERNAME="select id from usuarios where username =";
const SQL_ID_CATEGORIAS_BY_CATEGORIA="select id from categorias where categoria = ";
const SQL_ID_ITEMS_BY_NOMBRE="select id from items where nombre = ";
const SQL_ID_NOMBRE_ITEMS_BY_BETWEEN_FCHAFIN="select id, nombre from items where fechafin between ";

const SQL_ID_PUJAS_BY_ID_ITEM="select id From pujas where id_item =";
const SQL_IDUSER_CATIDAD_PUJAS_BY_IDITEM="select id_user, cantidad from pujas where id_item =";
const SQL_ID_NOMBRE_ITEMS_BY_FECHAFIN="select id, nombre from items where fechafin ";

const SQL_REGISTRO_EMAIL="select email, cadenaverificacion from usuarios where email = ";
const SQL_DATOS_USUARIO_POR_USERNAME="SELECT * FROM usuarios where username = ";
const SQL_USERNAME_PASSWORD_USUARIOS="SELECT username, password, activo FROM usuarios";
const SQL_PRECIOPARTIDA_ITEMS="select preciopartida from items  where id = ";
const SQL_MAX_CANTIDAD_PUJA="select max(cantidad) as cant from pujas where pujas.id_item =";
const SQL_FECHAFIN_ITEMS="select fechafin from items  where id = ";
const SQL_IMAGEN_BY_ID="select imagen from imagenes where id_item =";
const SQL_DESCRIPCION_ITEMS_BY_ID="select descripcion from items where id =";
const SQL_USERNAME_CANTIDAD_PUJAS_USUARIOS_BY_ID="select username, cantidad from pujas inner join usuarios on usuarios.id = id_user where id_item = ";
const SQL_NOMBRE_FROM_USUARIOS_BY_ID="select nombre from usuarios where id =";
const SQL_NOMBRE_ITEMS_BY_ID="select nombre from items where id = ";
const SQL_FECHAFIN_ITEMS_BY_ID="select fechafin from items where id =";
const SQL_PRECIOPATIDA_ITEMS_BY_ID="select preciopartida from items where id=";

const SQL_MAX_CANTIDAD_PUJAS_BY_IDITEM= "select max(cantidad) from pujas where id_item =";

const SQL_INSERT_PUJAS="INSERT INTO pujas (id, id_item, id_user, cantidad, fecha) VALUES (";
const SQL_INSERT_IMAGES="INSERT INTO imagenes values ";
const SQL_INSERT_ITEMS="INSERT INTO items (id, id_cat, id_user, nombre, preciopartida, descripcion, fechafin) VALUES ( ";
const SQL_INSERT_USUARIO="INSERT INTO usuarios (id, username, nombre, password, email, cadenaverificacion, activo, falso) VALUES (";

const SQL_DELETE_ITEMS_BY_ID="DELETE FROM items WHERE id = ";
const SQL_DELETE_PUJAS_BY_ID="DELETE FROM pujas WHERE id = ";
const SQL_DELETE_IMAGENES_BY_IMAGEN="DELETE FROM imagenes WHERE imagen = ";

const SQL_UPDATE_USUARIO_ACTIVO_WHERE_ID="update usuarios set activo = '1' where id =";

const SQL_COUNT_PUJAS_BY_FECHAS="select count(id) as cuenta from pujas where fecha = date_format(sysdate(),'%Y-%m-%d' ";
const SQL_COUNT_PUJAS= "select count(pujas.id) as cuenta from pujas where id_item = ";
const SQL_COUNT_ITEMS="select count(id) from items ";



//ORDER
const SQL_ORDERBY_CANTIDAD_DESC=" order by cantidad desc";
?>