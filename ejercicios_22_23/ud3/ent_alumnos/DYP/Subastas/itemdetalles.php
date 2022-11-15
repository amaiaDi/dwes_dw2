<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //Ver Todas
        $sql = "SELECT *
                FROM ITEMS
                WHERE ITEMS.id = '$id'";
        $result = mysqli_query($con, $sql);

        $fila = mysqli_fetch_assoc($result);
        $nombre = $fila['nombre'];
        $descripcion = $fila['descripcion'];
        $precioPartida = $fila['preciopartida'];
        $fechafin = $fila['fechafin'];
        // Sacar imagenes del item
        $imagenes = sacarImagenes($con, $fila['id']);

        //Ver sacar cuantas pujas
        $pujas = sacarCantidadPujas($con, $fila['id']);

        // Sacar precio actual
        $precio = sacarPrecio($con, $fila['id'], $fila['preciopartida']);
    }

    function sacarPrecio($con, $id, $precioaComparar){
        $sql = "SELECT max(cantidad)
                FROM PUJAS
                where EXISTS
                    (SELECT *
                    FROM ITEMS
                    WHERE ITEMS.ID = PUJAS.ID_ITEM
                    AND ITEMS.id = '$id')";
        $result = mysqli_query($con, $sql);
        $fila = mysqli_fetch_Array($result);
        if($fila[0] > $precioaComparar){
            return $fila[0];
        }else{
            return $precioaComparar;
        }
    }

    function sacarCantidadPujas($con ,$id){
        $sql = "SELECT count(*) 
                FROM PUJAS
                where EXISTS
                    (SELECT *
                    FROM ITEMS
                    WHERE ITEMS.ID = PUJAS.ID_ITEM
                    AND ITEMS.id = '$id')";
        $result = mysqli_query($con, $sql);
        $fila = mysqli_fetch_Array($result);
        if($fila == null){
            return 0;
        }else{
            return $fila[0];
        }
    }

    function sacarImagenes($con, $id){
        $sql = "SELECT imagen 
                FROM imagenes
                where EXISTS
                    (SELECT id
                    FROM ITEMS
                    WHERE ITEMS.ID = IMAGENES.ID_ITEM
                    AND ITEMS.ID = '$id')";
        $result = mysqli_query($con, $sql);
        $strImagenes = "";
        while( $fila = mysqli_fetch_assoc($result)){
            $imagen = $fila['imagen'];
            $strImagenes = $strImagenes."<img src='imagenes/$imagen' width='150px'>";
        }
        return $strImagenes;
    }

    function historialPuja(){
        global $id;
        global $con;

        $sql = "SELECT usuarios.nombre, pujas.cantidad
                from usuarios, pujas, items
                where items.id = '$id'
                and items.id = pujas.id_item
                and pujas.id_user = usuarios.id";
        $result = mysqli_query($con, $sql);

        $str = "";
        while( $fila = mysqli_fetch_assoc($result)){
            $nombre = $fila['nombre'];
            $precioPuja = $fila['cantidad'];
            
            $str = $str."<li>$nombre - $precioPuja</li>";
        }
        return $str;
    }

    function  sacarCuantasPujasLLevaHoy($con, $usuario, $fechaHoy){
        $sql = "SELECT count(*)
                from pujas
                where fecha = '$fechaHoy'
                and exists
                            (select id
                            from usuarios
                            where id = id_user
                            and nombre = '$usuario')";
        $result = mysqli_query($con, $sql);

        $fila = mysqli_fetch_assoc($result);
            if($fila['count(*)'] != 0){
                return $fila['count(*)'];
            }else{
                return "0";
            }
    }

    // Tratar errores
    $error = "";
    if(isset($_POST['botonPuja'])){
        $precioApujar = $_POST['puja'];
        $precioActual = sacarPrecio($con, $id, 0);
        if($precioActual >= $precioApujar){
            $error = "Puja muy baja";
        }else{
            $usuario = $_SESSION['usuario'];
            //Sacar fecha hoy
            $anioActual = date('Y');
            $diaActual = date('d');
            $mesActual = date('m');
            $fechaHoy = $anioActual."-".$mesActual."-".$diaActual;

            $contPujasHoy = intval(sacarCuantasPujasLLevaHoy($con, $usuario, $fechaHoy));
            if($contPujasHoy < 3){
                $idUsuario = $_SESSION['id'];
                $precioApujar = $_POST['puja'];

                $sql = "INSERT INTO pujas (id_item, id_user, cantidad, fecha) 
                                  VALUES ('$id','$idUsuario','$precioApujar','$fechaHoy')";  
                global $con;
                $resultado = mysqli_query($con, $sql); 
            }else{
                $error = "Llevas mas de 3 pujas hoy";
            }
        }
    }
?>
<div>
    <!-- Descripcion -->
    <h1><?php echo $descripcion;?></h1>
    <h3>Número de pujas: <?php echo $pujas;?> </h3>
    <h3>Precio actual: <?php echo sacarPrecio($con, $id, 0);?>€ </h3>
    <h3>Fecha fin para pujar: <?php echo $fechafin;?> </h3>
    <?php echo $imagenes;?>
    <br><br>
    <!-- Puja -->
    <?php 
        if(isset($_SESSION['usuario'])){    
    ?>
        <!-- Si se ha iniciado sesion -->
        <form  action="index.php?ir=itemdetalles&id=<?php echo $id;?>" method="post">
                            <table>
                                <tr class="body">
                                    <tr>
                                        <td><input type="text" name="puja" required/></td>
                                        <td><input type="submit" value="¡Puja!" name="botonPuja"/></td>
                                        <span style="color: red;"><?php echo $error;?></span><br>
                                    </tr>
                                </tr>
                            </table>
        </form>
    <?php 
        }else{     
    ?>
        <!-- Si no -->
        Para pujar, debes autenticarte.
        <a href='index.php?ir=login&vengode=itemdetalles&id=<?php echo $id;?>'> Aqui</a>
    <?php 
        }   
    ?>
    <br>
    <!-- HISTORIAL DE PUJAS -->
    <h1>Historial de la puja</h1>
    <ul>
        <?php echo historialPuja();?>
    </ul>
</div>
