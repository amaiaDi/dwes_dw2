<?php
    require("cabecera.php");
    if(!isset($_SESSION['usuario']))
        header('Location: login.php?url='.$_SERVER["REQUEST_URI"]);
    else
        $_SESSION['ultimaPagina'] = $_SERVER["REQUEST_URI"];
    if(isset($_POST['botrenviar'])){
        $hoy = date('Y-m-d');
        $fecha = date($_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia']);
        if(checkdate($_POST['mes'], $_POST['dia'], $_POST['anio'])){
            if($fecha>$hoy){
                //Consulta id categoria
                $consultaIdCat = "SELECT id FROM categorias WHERE '".$_POST['categoria']."' = categoria";
                $resultadoIdCat= mysqli_query($con, $consultaIdCat);
                $id_cat = mysqli_fetch_assoc($resultadoIdCat);
                //Insertar nuevo item
                $sql = "INSERT INTO items (id_cat,id_user,nombre,preciopartida,descripcion,fechafin) VALUES ('".$id_cat['id']."','".$_SESSION['id']."','".$_POST['nombre']."','".$_POST['precio']."','".$_POST['descripcion']."','".$fecha."')"; 
                $resultado = mysqli_query($con, $sql); 
                if(mysqli_errno($con)) die(mysqli_error($con));
                //Consulta id nuevo item
                $consultaIdNewItem = "SELECT MAX(id) FROM items";
                $resultadoIdNewItem= mysqli_query($con, $consultaIdNewItem);
                $idNewItem = mysqli_fetch_assoc($resultadoIdNewItem);
                header('Location: editaritem.php?id='.$idNewItem['MAX(id)']);
            }
            else
                echo "<p style='color:red;'>Debes de introducir una fecha mayor a la actual!</p>";
        }
        else
            echo "<p style='color:red;'>Fecha invalida!</p>";
    }

    function selectCategorias($con){
        $sql = "SELECT * FROM categorias";
        $result = mysqli_query($con, $sql);
        while($fila = mysqli_fetch_array($result)){
            echo "<option value='".$fila['categoria']."'>".$fila['categoria']."</option>";
        }
    }
    function rellenartablaFechaHora($ini, $fin){
        for($i = $ini; $i<=$fin ; $i++){
            echo "<option value='".$i."'>".$i."</option>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo DB_TITULO." Añade un nuevo item"; ?></title>
</head>
<body>
    <h1>Añade un nuevo item</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <table>
            <tr>
                <th>Categoría</th>
                <td>
                    <select name="categoria" required>
                        <?php selectCategorias($con); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td><input type="text" name="nombre" id="nombre" required></td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td><textarea name="descripcion" rows="10" cols="45" required></textarea></td>
            </tr>
            <tr>
                <th>Fecha de fin para pujas</th>
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
                            <td> <select name="dia" required><?php rellenartablaFechaHora("1","31"); ?></select> </td>
                            <td> <select name="mes" required><?php rellenartablaFechaHora("1","12"); ?></select> </td>
                            <td> <select name="anio" required><?php rellenartablaFechaHora(ANIO, ANIO+4); ?></select> </td>
                            <td> <select name="hora" required><?php rellenartablaFechaHora("0","23"); ?></select> </td>
                            <td> <select name="minutos" required><?php rellenartablaFechaHora("0","59"); ?> </select> </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th>precio</th>
                <td><input type="number" name="precio" id="precio" required><?php echo DB_MONEDA; ?></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="botrenviar" value="Enviar!"></td>
            </tr>
        </table>
    </form>
    <?php  require("pie.php"); ?>
</body>
</html>