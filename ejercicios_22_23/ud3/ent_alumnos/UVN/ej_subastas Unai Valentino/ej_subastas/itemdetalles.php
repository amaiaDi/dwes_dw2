<?php
    require('header.php');

    $idItem = $_GET['id'];
    //Consultas
    $consultaItem = "SELECT * FROM items WHERE id = ".$idItem.";";
    $resultadoItem = mysqli_query($conn, $consultaItem);
    $item = mysqli_fetch_assoc($resultadoItem);

    $consultaPujas = "SELECT COUNT(*) FROM pujas where id_item = $idItem group by id_item;";
    $resultPujas = mysqli_query($conn, $consultaPujas);
    $pujas = mysqli_fetch_assoc($resultPujas);

    $consultaPrecio = "SELECT MAX(cantidad) FROM pujas where id_item = $idItem group by id_item;";
    $resultPrecio = mysqli_query($conn, $consultaPrecio);
    $precio = mysqli_fetch_assoc($resultPrecio);

    //Detalles
    echo "<h1>".ucfirst($item['nombre'])."</h1>";
    echo "<p><strong>Número de pujas: </strong>";
    echo $pujas == null? 0 : $pujas['COUNT(*)'];
    echo " - <strong>Precio actual: </strong>";
    echo $precio == null? $item['preciopartida'] . "€" : $precio['MAX(cantidad)'] . "€";
    echo " - <strong>Fecha fin para pujar: </strong>".$item['fechafin'];
    echo "</p>";

    //Imagenes
    $consultaImg = "SELECT imagen FROM imagenes where id_item = $idItem;";
    $resultImg = mysqli_query($conn, $consultaImg);

    while($imagen = mysqli_fetch_row($resultImg)){
        echo $imagen == null? 'NO IMAGEN' : '<img src="img/'.$imagen[0].'" alt="'.$imagen[0].'" width="200"/> ';
    }
    
    //Descripcion
    echo "<p>".$item['descripcion']."</p>";

    //Puja
    echo "<h1>Puja por este item</h1>";

    if(!isset($_SESSION['usuario'])){
        $_SESSION['anteriorP'] = $_SERVER["REQUEST_URI"];
        echo "<p>Para pujar, debes autenticarte.<a href='login.php'>aqui</a></p>";
    }
    else{
        
        $este = $_SERVER['REQUEST_URI'];
        echo "<form action='$este' method='post'>
                <table>
                    <tr>
                        <td><input type='number' name='puja'></td>
                        <td style='color: red'><input type='submit' value='¡Puja!' name='pujar'>";
                        //Comprobacion de errores e insercion de la puja
                        if(isset($_POST['pujar']) && isset($_POST['puja'])){
                            $consultaPujaUsu = "SELECT COUNT(*) FROM pujas WHERE id_user = ".$_SESSION['id']." AND fecha = '".date('Y-m-d')."' GROUP BY fecha;";
                            $resultPujaUsu = mysqli_query($conn, $consultaPujaUsu);
                            $pujaUsu = mysqli_fetch_assoc($resultPujaUsu);

                            $precio == null? $mayor = $item['preciopartida'] : $mayor =  $precio['MAX(cantidad)'];
                            if($_POST['puja'] < $mayor){
                                echo " Puja muy baja!";
                            }
                            else if(isset($pujaUsu['COUNT(*)']) && $pujaUsu['COUNT(*)']>=3){
                                echo " Límite de 3 pujas por día";
                            }
                            else{
                                $consultaId = "SELECT MAX(id) FROM pujas";
                                $resultadoId = mysqli_query($conn, $consultaId);
                                $idMax = mysqli_fetch_assoc($resultadoId);
                                $nuevoId = $idMax['MAX(id)'] + 1;
                                $insertarPuja = "INSERT INTO pujas VALUES ($nuevoId, $idItem, ".$_SESSION['id'].", ".$_POST['puja'].", '".date('Y-m-d')."');";
                                mysqli_query($conn, $insertarPuja);
                                header('Location: '.$_SERVER["REQUEST_URI"]);
                            }
                        }
                        echo "</td>
                    </tr>
                </table>
            </form>";

        //Historial de puja
        echo "<h1>Historial de la puja</h1>";
        if($pujas != null){
            echo "<ul>";
            $consultaHistorial = "SELECT * FROM pujas WHERE id_item = $idItem ORDER BY `fecha` DESC,`cantidad` DESC;";
            $resultadoHistorial = mysqli_query($conn, $consultaHistorial);
            while($historial = mysqli_fetch_row($resultadoHistorial)){
                $consultaUsuario = "SELECT username from usuarios where id = $historial[2];";
                $resultadoUsuario = mysqli_query($conn, $consultaUsuario);
                $usuario = mysqli_fetch_assoc($resultadoUsuario);;
                echo "<li> ".$usuario['username']." - ".$historial[3]."€</li>";
            }
            echo "</ul>";
        }
    }


    require('pie.php');
?>
