<?php 
//session_start();
include_once("config.php");
include_once("funciones.php");

//Crear conexion BD
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
mysqli_select_db($con, DB_DATABASE);

if(empty($_SESSION["usuario"])){
    //header("location:index.php");
}
?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <h1>AÑADE NUEVO ITEM</h1>
        <table>
            <tr>
                <td>Categoria</td>
                <td><?php echo  mostrarCategoriasSelect($con);?></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nombre" value=""></td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><input type="textarea" name="descripcion" value=""></td>
            </tr>
            <tr>
                <td>Fecha de fin para pujas</td>
                <td>
                    <table>
                        <tr>
                            <td>Día</td>
                            <td>Mes</td>
                            <td>Año</td>
                            <td>Hora</td>
                            <td>Minutos</td>
                        </tr>
                        <tr>
                            <td><input type="number" id="dia" name="dia"  min="1" max="31"></td>
                            <td><input type="number" id="mes" name="mes"  min="1" max="12"></td>
                            <td><input type="number" id="ano" name="ano"  min="2022" max="2027"></td>
                            <td><input type="number" id="hora" name="hora"  min="0" max="23"></td>
                            <td><input type="number" id="minutos" name="minutos"  min="0" max="59"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Precio</td>
                <td><input type="text" name="precio" value=""/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="enviar" name="enviar"/></td>
            </tr>
        </table>
    </form>