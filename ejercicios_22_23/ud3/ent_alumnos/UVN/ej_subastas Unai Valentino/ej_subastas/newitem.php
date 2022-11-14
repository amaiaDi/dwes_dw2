<?php
    require('header.php');
    if(!isset($_SESSION['usuario'])){
        $_SESSION['anteriorP'] = $_SERVER["REQUEST_URI"];
        header('Location: login.php');
    }
    else{
        $consultaCategoria = "SELECT categoria FROM categorias;";
        $resultadoCategoria = mysqli_query($conn, $consultaCategoria);
        echo "<h1>Añade nuevo item</h1>";
        if(isset($_POST['nuevo'])){
            $sw = 1;
            $dia = $_POST['dia'];
            $mes = $_POST['mes'];
            $anio = $_POST['anio'];
            $hora = $_POST['hora'];
            $min = $_POST['min'];
            $fechaActual = strtotime(date("Y-m-d H:i"));
            $fechaSelec = strtotime(date("$anio-$mes-$dia $hora:$min"));
            $precio = $_POST['precio'];
            if($fechaSelec <= $fechaActual){
                $sw = 0;
                echo "<h2 style='color: red'>La fecha es inferior o igual a la actual</h2>";
            }
            if($precio <= 0){
                $sw = 0;
                echo "<h2 style='color: red'>El precio tiene que ser mayor a 0</h2>";
            }
            if($sw == 1){
                $consultaId = "SELECT MAX(id) FROM items";
                $resultadoId = mysqli_query($conn, $consultaId);
                $idMax = mysqli_fetch_assoc($resultadoId);
                $nuevoId = $idMax['MAX(id)'] + 1;
                
                $categoria = $_POST['cat'];
                $consultaCat = "SELECT id FROM categorias WHERE categoria = '$categoria';";
                $resultadoCat = mysqli_query($conn, $consultaCat);
                $catId = mysqli_fetch_assoc($resultadoCat);
                
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $fechaLimite = date("$anio-$mes-$dia $hora:$min");
                $insertarItem = "INSERT INTO items VALUES($nuevoId, ".$catId['id'].", ".$_SESSION['id'].", '$nombre', $precio, '$descripcion', '$fechaLimite');";
                mysqli_query($conn, $insertarItem);
                header('Location: editaritem.php?id='.$nuevoId);
            }
        }
        echo "<form action='newitem.php' method='post'>
        <table>
            <tr>
                <td>Categoría</td>
                <td>
                    <select name='cat'>";
                foreach($resultadoCategoria as $as){
                    $cat = $as['categoria'];
                    echo "<option value='$cat'>$cat</option>";
                }
                echo "</select>
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type='text' name='nombre' required></td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><textarea name='descripcion' cols='50' rows='10' style='resize: none; overflow-y: scroll' required></textarea></td>
            </tr>
            <tr>
                <td>Fecha de fin de pujas</td>
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
                            <td>
                                <select name='dia'>";
                            for($i=1;$i<=31;$i++){
                                echo "<option value='$i'>$i</option>";
                            }
                            echo "</select>
                            </td>
                            <td>
                                <select name='mes'>";
                            for($i=1;$i<=12;$i++){
                                echo "<option value='$i'>$i</option>";
                            }
                            echo "</select>
                            </td>
                            <td>
                                <select name='anio'>";
                            $date = date("Y");
                            for($i=$date;$i<=$date+5;$i++){
                                echo "<option value='$i'>$i</option>";
                            }
                            echo "</select>
                            </td>
                            <td>
                                <select name='hora'>";
                            for($i=0;$i<=23;$i++){
                                echo "<option value='$i'>$i</option>";
                            }
                            echo "</select>
                            </td>
                            <td>
                                <select name='min'>";
                            for($i=0;$i<=59;$i++){
                                echo "<option value='$i'>$i</option>";
                            }
                            echo "</select>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Precio</td>
                <td><input type='number' name='precio' required>€</td>
            </tr>
            <tr>
                <td colspan='2'><input type='submit' value='Enviar!' style='width: 100%' name='nuevo'></td>
            </tr>
        </table>
    </form>";
    }
    require('pie.php');
?>

