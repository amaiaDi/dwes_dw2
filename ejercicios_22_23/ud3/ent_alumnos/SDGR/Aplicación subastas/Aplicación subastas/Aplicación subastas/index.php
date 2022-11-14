<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylesheet.css">
    <title><?php require "config.php";echo $nombre_Foro = NOMBRE_FORO;?></title>
</head>
    <body>
    <?php 
        session_start();
        require "cabecera.php";
        $_SESSION["ultima_pagina"] = "index.php";
    ?>
        <div id="container">
            <div id="bar">
                <?php require "barra.php"?>
            </div>
            <main id="main">
                <table>
                    <h2>Items disponibles</h2>
                    <tr class="head">
                        <th>IMAGEN</th>
                        <th>ITEM</th>
                        <th>PUJAS</th>
                        <th>PRECIO</th>
                        <th>PUJAS HASTA</th>
                    </tr>
                    <?php    
                        if(isset($_GET["categoria"]))
                            sacarCategoria($_GET["categoria"],$conn);
                        else
                            sacarCategoria(null,$conn);
                    ?>
                </table>
        <?php require "pie.php"?>
    </body>
    <?php 
        function sacarCategoria($categoria,$conn){
            $sql = "select id, (select imagen from imagenes img where img.id_item = it.id limit 1) img, nombre, (select max(cantidad) from pujas p where p.id_item = it.id) cantidad_actual, (select count(*) from pujas p where p.id_item = it.id) cont ,preciopartida, fechafin, id_User from items it";
            if($categoria != null)
                $sql = $sql . " where id_Cat = $categoria";  
            $resultado = $conn->query($sql);  
            if($conn->errno) die($conn->error);  
            while($fila = $resultado -> fetch_assoc()){  
                echo "<tr class='body'>";
                if($fila["img"] != null)
                    echo "<td><img src=".IMAGENES . "/".$fila["img"] ." width='200rem'></td>";
                else
                    echo "<td>NO IMAGEN</td>";
                $editar = "";
                if(isset($_SESSION["id_usuario"]) && $fila["id_User"] == $_SESSION["id_usuario"]){
                    $editar =" - <a href='editaritem.php?item=". $fila["id"] ."'>[editar]</a>";
                }
                echo "<td><a href='itemdetalles.php?id=". $fila["id"] ."'>". $fila["nombre"] ."</a>". $editar ."</td>";
                echo "<td>". $fila["cont"] ."</td>";
                if($fila["cantidad_actual"] != null)
                    echo "<td>". number_format($fila["cantidad_actual"], 2, ",", ".") ."€</td>";
                else
                    echo "<td>". number_format($fila["preciopartida"], 2, ",", ".") ."€</td>";
                echo "<td>". $fila["fechafin"] ."</td>";
                echo "<tr/>";
            } 
        }
    ?>
</html>