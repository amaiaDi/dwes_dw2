<?php
    require('header.php');

    if(isset($_GET['id']))
    {
        $_SESSION['id_item'] = $_GET['id'];
    }
    $id_item = $_SESSION['id_item'];
    $consultaPujasSQL = "SELECT count(*) FROM pujas where id_item = $id_item;";
    $resulPujasSQL = mysqli_query($conn, $consultaPujasSQL);
    $pujas = mysqli_fetch_assoc($resulPujasSQL);

    $consultaItemSQL = "SELECT * FROM items where id = $id_item;";
    $resulItemSQL = mysqli_query($conn, $consultaItemSQL);
    $item = mysqli_fetch_assoc($resulItemSQL);

    $consultaPrecioActualSQL = "SELECT cantidad FROM pujas where id_item = $id_item ORDER BY fecha DESC;";
    $resulPrecioActualSQL = mysqli_query($conn, $consultaPrecioActualSQL);
    $precioActual = mysqli_fetch_assoc($resulPrecioActualSQL);

    $consultaImagenSQL = "SELECT imagen FROM imagenes where id_item = $id_item;";
    $resulImagenSQL = mysqli_query($conn, $consultaImagenSQL);

    echo "<h1>" . $item['nombre'] . "</h1>";
    echo "<p style='font-size : 14px'><strong>Numero de pujas: </strong>";
    echo $pujas == null ?  0 : $pujas['count(*)'];
    echo " - <strong>Precio actual: </strong>";
    echo $precioActual == null ? $item['preciopartida'] : $precioActual['cantidad'];
    echo "€ - <strong>Fecha fin para pujar </strong>: " . $item['fechafin'] . "</p>";
    
    foreach($resulImagenSQL as $imagen) {
        echo '<img src="assets/img/'.$imagen['imagen'].'" alt="imagen" width="100">';
    }

    echo "<p>" . $item['descripcion'] . "</p>";
    echo "<h1>Puja por este item</h1>";

    if(!isset($_SESSION['user']))
    {
        echo "<p>Para pujar, debes autenticarte <a href='login.php'>AQUÍ</a></p>";
        $_SESSION['pagina'] = "itemdetalles.php?id=$id_item";
    }
    else
    {
        echo "<form action='itemdetalles.php' method='post'>
            <table>
                <td><input type='number' name='puja'></td>
                    <td><input type='submit' name='btnPuja' value='¡Puja!'>";
                    if(isset($_POST['btnPuja']))
                    {
                        $user_id = $_SESSION['id'];
                        $date = date('Y-m-d');
                        $consultaCantidadPujasDiarasSQL = "SELECT count(*) FROM pujas where id_user = $user_id and fecha = '$date';";
                        $resulCantidadPujasDiarasSQL = mysqli_query($conn, $consultaCantidadPujasDiarasSQL);
                        $cantidadPujasDiarias = mysqli_fetch_assoc($resulCantidadPujasDiarasSQL);

                        $cantPuja = $_POST['puja'];
                        if($cantidadPujasDiarias['count(*)'] >= 3)
                        {
                            echo "<strong style='color: red'> Límite de 3 pujas por dia</strong>";
                        }
                        else if((isset($precioActual) && $cantPuja <= $precioActual['cantidad']) || (!isset($precioActual) && $cantPuja <= $item['preciopartida']))
                        {
                            echo "<strong style='color: red'> Puja muy baja!</strong>";
                        }
                        else
                        {
                            $consultaIdSQL = "SELECT max(id) FROM pujas";
                            $resulIdSQL = mysqli_query($conn, $consultaIdSQL);
                            $maxId = mysqli_fetch_assoc($resulIdSQL);
                            $id = $maxId['max(id)'] + 1;
                            $insertarPuja = "INSERT INTO pujas VALUES('$id', '$id_item', '$user_id', '$cantPuja', '$date')";
                            $resulCantidadPujasDiarasSQL = mysqli_query($conn, $insertarPuja);
                        }
                    }
                    echo "</td>
            </table>
        </form>";
        echo "<h1>Historial de la puja</h1>";
        echo "<ul>";
            $consultaHistorialSQL = "SELECT SUM(cantidad), id_user FROM pujas WHERE id_item = $id_item group by id_user;";
            $resulHistorialSQL = mysqli_query($conn, $consultaHistorialSQL);
            foreach ($resulHistorialSQL as $historial) {
                $user = $historial['id_user'];
                $consultaUserSQL = "SELECT username FROM usuarios WHERE id = $user";
                $resulUserSQL = mysqli_query($conn, $consultaUserSQL);
                $userName = mysqli_fetch_assoc($resulUserSQL);
                
                echo "<li style='font-size : 20px'>" . $userName['username'] . " - " . $historial['SUM(cantidad)'] ."€</li>";
            }
        echo "</ul>";
    }
    require('pie.php');
?>