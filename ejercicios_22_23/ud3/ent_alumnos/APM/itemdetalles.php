<?php require "cabecera.php";
$_SESSION['link'] = $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<div>
    <?php //INFO ITEM
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        $img = "img/";
        $id = $_GET['id'];
        $sql = "select *,round(max(preciopartida),2) as precpar, (select count(id) from pujas p2 where p2.id_item = it.id) as cant, (select round(max(cantidad),2) from pujas p2 where p2.id_item = it.id) as prec
        from items it
        where it.id = $id";
        $resultado = $conn->query($sql);  
        if($conn->errno) die($conn->error);
        $fila = $resultado -> fetch_assoc();
        echo "<h2>" . $fila['nombre'] . "</h2>";
        if ($fila['cant']>0) {
            $precio = $fila['prec'];
        } else {
            $precio = $fila['precpar'];
        }
        echo "<p>Numero de pujas: " . $fila['cant']  . " - Precio actual: " . $precio .  "€ - Fecha fin para pujar: " . $fila['fechafin'] . "</p>";
        $sql = "select imagen from imagenes where id_item = $id";
        $resultado = $conn->query($sql);  
        if($conn->errno) die($conn->error);
        while ($fila2 = $resultado -> fetch_assoc()) {
            if ($fila2['imagen']) echo "<img src=" . $img . $fila2['imagen'] . ">";
            //echo "<h5>SIN IMAGEN</h5>";
        }
        echo "<p>" . $fila['descripcion'] . "</p>";
    ?>
    <h2>Puja por este item</h2>
    <?php if (isset($_SESSION['user'])) : //SI USUARIO VERIFICADO PUJAR + HISTORIAL DE PUJAS?>
        <div> <!-- PUJAR -->
            <h3>Añade tu puja en el cuadro inferior</h3>
            <form action="<?= 'itemdetalles.php?id=' . $id ?>" method="post">
                <table>
                    <tr>
                        <td><input type="text" name="puja" id="puja"></td>
                        <td><input type="submit" value="Pujar" name="pujar"></td>
                        <?php
                            if (isset($_GET['np'])) {
                                if ($_GET['np']==1)  echo "<td class='red'>PUJA MUY BAJA</td>";
                                if ($_GET['np']==2)  echo "<td class='red'>SOLO PUEDES HACER 3 PUJAS</td>";
                            }
                        ?>
                    </tr>
                </table>
            </form>
        </div>

        <div> <!-- HISTORIAL DE PUJAS -->
            <h3>Historial de la puja</h3>
            <?php 
                $sql = "select nombre, round(cantidad,2) as cant from pujas p, usuarios u where id_item = '$id' and p.id_user = u.id";
                $resultado = $conn->query($sql);  
                if($conn->errno) die($conn->error);
                echo "<ul>";
                while($fila = $resultado -> fetch_assoc()){
                    echo "<li>". $fila['nombre'] . " - " . $fila['cant'] . "€</li>";
                }
                echo "</ul>";
                
                //EJECUTAR AL PUJAR
                if (isset($_POST['pujar'])) {
                    $sql = "select round(max(cantidad),2) as max,(select count(id) from pujas where id_item = '$id' and id_user = '$user' and datediff(fecha, curdate()) = 0) as puede from pujas p where id_item = '$id'";
                    $resultado = $conn->query($sql);  
                    if($conn->errno) die($conn->error);
                    $fila = $resultado -> fetch_assoc();

                    //CONTROL DE PUJA MINIMO
                    if ($_POST['puja']<=$fila['max']||$_POST['puja']<=$precio) {
                        header("Location: itemdetalles.php?np=1&id=$id");
                        return;
                    }

                    //CONTROL DE PUJAS POR DIA
                    if ($fila['puede']==3) {
                        header("Location: itemdetalles.php?np=2&id=$id");
                        return;
                    }

                    $puja = $_POST['puja'];
                    $date = date('Y-m-d');
                    $sql = "INSERT INTO `pujas`(`id_item`, `id_user`, `cantidad`, `fecha`) VALUES ('$id','$user','$puja','$date')";
                    $resultado = $conn->query($sql);
                    if($conn->errno) die($conn->error);
                    header("Location: itemdetalles.php?id=$id");
                }
            ?>
        </div>
    <?php else : ?>
        <h5>Para pujar debes autenticarte <a href="login.php">aqui</a></h5>
    <?php endif; ?>
</div>
<?php require "pie.php"; ?>