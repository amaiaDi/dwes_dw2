<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Detalles</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>
    <?php include "config.php";
        $nombre_Foro = NOMBRE_FORO;
        session_start();
        require "cabecera.php";
        if(!isset($_SESSION["id_usuario"])){
            $_SESSION["ultima_pagina"] = "nuevoitem.php";
            header("Location: login.php");
            return;
        }
    ?>
    <div id="container">
        <h1>Añade nuevo item</h1>
        <?php 
            if(isset($_POST["crearItem"])){
                if(validarCampos()){
                    $id_cat = $_POST["categoria"];
                    $id_user = $_SESSION["id_usuario"];
                    $nom = $_POST["nombre_producto"];
                    $precio = $_POST["precio"];
                    $desc = $_POST["descripcion"];
                    $fecha = $_POST["anio"] . "-" . $_POST["mes"]. "-" . $_POST["dia"] . " " . $_POST["hora"] . ":" . $_POST["minutos"] . ":00"; 
                    $sql_aniadir_item = "INSERT INTO `items`(`id_Cat`, `id_User`, `nombre`, `preciopartida`, `descripcion`, `fechafin`) VALUES ('$id_cat','$id_user','$nom','$precio','$desc','$fecha')";
                    $resul = $conn -> query($sql_aniadir_item);
                    if($conn -> errno)die($conn -> error);
                    $sql_id_item = "SELECT id FROM items ORDER BY id DESC LIMIT 1";
                    $resul_id = $conn -> query($sql_id_item);
                    if($conn -> errno) die($conn -> error);
                    $item = $resul_id -> fetch_assoc();
                    $item_id = $item["id"];
                    header("Location: editaritem.php?item=$item_id");
                }
            }
        ?>
        <form action="" method="post">
            <table>
                <tr>
                    <td><label for="categoria">Categoria</label></td>
                    <td>
                        <select name="categoria" id="categoria">
                            <?php 
                                $sql = "SELECT id, categoria FROM categorias";
                                $resultado = $conn-> query($sql);
                                if($conn->errno) die($conn->error);
                                while($fila = $resultado -> fetch_assoc()){
                                    $id = $fila["id"];
                                    $categoria = $fila["categoria"];
                                    echo "<option value=$id>$categoria</option>"; 
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="nombre_producto">Nombre</label></td>
                    <td><input type="text" name="nombre_producto" id="nombre_producto"></td>
                </tr>
                <tr>
                    <td><label for="descripcion">Descripcion</label></td>
                    <td><textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td><label for="fecha_fin">Fecha de fin para pujas</label></td>
                    <td>
                    <table>
                            <tr>
                                <td>Dia</td>
                                <td>Mes</td>
                                <td>Año</td>
                                <td>Hora</td>
                                <td>Minutos</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="dia" id="dia">
                                        <?php crearOptions(1,31) ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="mes" id="mes">
                                        <?php crearOptions(1,12) ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="anio" id="anio">
                                        <?php 
                                            $date = intval(date_format(date_create(),"Y"));
                                            crearOptions($date,$date+20);
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="hora" id="hora">
                                    <?php crearOptions(0,23); ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="minutos" id="minutos">
                                        <?php crearOptions(0,59) ?>
                                    </select>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td><label for="precio">Precio</label></td>
                    <td><input type="text" name="precio" id="precio">€</td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="crearItem" value="Enviar!"></td>
                </tr>
            </table>
        </form>
        <?php 
            function crearOptions($inicio,$fin){
                while ($inicio <= $fin) {
                    echo "<option value='$inicio'>$inicio</option>";
                    $inicio++;
                }
            }
            function validarCampos(){
                if(empty($_POST["nombre_producto"]) || empty($_POST["descripcion"])|| empty($_POST["precio"])){
                    echo "<p>Falta rellenar campos</p>";
                    return false;
                }
                if(!is_numeric($_POST["precio"])){
                    echo "<p>El precio no es numerico</p>";
                    return false;
                }
                if(strlen($_POST["descripcion"]) >200){
                    echo "<p>La descripcion debe ser igual o menos de 200 caracteres</p>";
                    return false;
                }
                date_default_timezone_set("Europe/Madrid");
                $date = date_format(date_create(),"d/m/Y H:i");
                if(intval($_POST["anio"]) ==  intval(substr($date,6,4))&&((intval($_POST["mes"]) <  intval(substr($date,3,2))) ||(intval($_POST["mes"]) ==  intval(substr($date,3,2)) && intval($_POST["dia"]) < intval(substr($date,0,2))))){
                    echo "<p>Tiene que ser una fecha que no haya pasado</p>";
                    return false;
                }
                if(intval($_POST["anio"]) ==  intval(substr($date,6,4)) && intval($_POST["mes"]) ==  intval(substr($date,3,2)) && intval($_POST["dia"]) == intval(substr($date,0,2))){
                    $minTotalActual = intval(substr($date,11,2)) *60 + intval(substr($date,14,2));
                    $minTotalsupuesto = intval($_POST["hora"]) *60 + intval($_POST["minutos"]);
                    if($minTotalsupuesto - $minTotalActual <60){
                        echo "<p>Fecha debe tener minimo una hora de duracion</p>";
                        return false;
                    }
                }
                return true;    
            }
        ?>
    </div>
</body>
</html>