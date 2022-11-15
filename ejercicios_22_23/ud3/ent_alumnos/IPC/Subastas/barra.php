<?php 
include_once("config.php");
include_once("funciones.php");

//Crear conexion BD
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
mysqli_select_db($con, DB_DATABASE);
?>
<div>
<h1>CATEGORIAS</h1>
<?php 
    echo  mostrarCategoriasUl($con);
?>
</div>