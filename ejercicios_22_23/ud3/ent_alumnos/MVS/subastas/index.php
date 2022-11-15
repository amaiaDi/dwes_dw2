<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Subastas</title>
</head>
<body>
    <?php
        if (!isset($_GET['log'])) {
            unset($_SESSION['user']);
            unset($_SESSION['pass']);
        }
    ?>
    <div id="header"><h1>SUBASTAS DEWS</h1></div>
    <div id="menu">
        <a href="#">Home</a>
        <?php
            if (isset($_SESSION['user'])) {
                echo "<a href='index.php?log'>Logout</a>";
            }
            else {
                echo "<a href='login.php'>Login</a>";
            }
        ?>
        <a href="#">Nuevo item</a>
    </div>
    <div id="container">
        <div id="bar">
            <?php
                include __DIR__ . '\barra.php';
            ?>
        </div>
        <div id="main">
            <table>
                <section><b>Items disponibles</b></section>
                <tr class="body">
                    <th>IMAGEN</th>
                    <th>ITEM</th>
                    <th>PUJAS</th>
                    <th>PRECIO</th>
                    <th>PUJAS HASTA</th>
                    <img src="" alt="">
                </tr>
                <?php
                    $mysqli = new mysqli("localhost", "marcos", "dw2", "subastas");
                    
                    if (isset($_GET['var'])) {
                        $var=$_GET['var'];
                        $sql="SELECT * FROM items where id_cat = $var";
                    }
                    else{
                        $sql="SELECT * FROM items";
                    }
                    
                    $resultado=$mysqli->query($sql);
                    
                    while($dato = $resultado->fetch_assoc())   {
                        $imagen="";
                        $sql2="SELECT id_item,imagen FROM imagenes where exists (select id from items where id_item = id)";
                        $resultado2=$mysqli->query($sql2);
                        while($dato2 = $resultado2->fetch_assoc())   {
                            if ($dato["id"]==$dato2["id_item"]) {
                                $imagen=$dato2["imagen"];
                            }
                        }
                        $cant="0";
                        $precM="0";
                        $sql3="SELECT id_item,cantidad FROM pujas where exists (select id from items where id_item = id)";
                        $resultado3=$mysqli->query($sql3);
                        while($dato3 = $resultado3->fetch_assoc())   {
                            if ($dato["id"]==$dato3["id_item"]) {
                                $cant++;
                                if ($precM<$dato3["cantidad"]) {
                                    $precM=$dato3["cantidad"];
                                }
                            }
                        }
                        if ($precM=="0") {
                            $precM=$dato["preciopartida"];
                        }
                        if ($imagen=="") {
                            echo "<tr class='body'><td>NO IMAGEN</td><td>" . $dato["nombre"] . "</td><td>".$cant."</td><td>".$precM."</td><td>".$dato["fechafin"]."</td></tr>";
                        }
                        else {
                            echo "<tr class='body'><td><img src='imagenes/" . $imagen . "'></td><td>" . $dato["nombre"] . "</td><td>".$cant."</td><td>".$precM."</td><td>".$dato["fechafin"]."</td></tr>";
                        }
                    }
                    $resultado->free();
                    $resultado2->free();
                    $resultado3->free();
                    $mysqli->close(); 
                ?>
            </table>
        </div>
    </div>
</body>
</html>