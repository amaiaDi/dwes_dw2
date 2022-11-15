<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>
    <?php include "config.php";
        $nombre_Foro = NOMBRE_FORO; 
        session_start();
        include "cabecera.php";
        $fila = [];
        $id = "";
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = "select *, (select max(cantidad) from pujas p where p.id_item = it.id) precio_actual ,(select count(*) from pujas p where p.id_item = it.id) cont  from items it where id = $id";
            $resultado = $conn->query($sql); 
            if($conn->errno) die($conn->error);
            $fila = $resultado -> fetch_assoc();
        }
    ?>
    <div id="container">
        <div id="bar">
            <?php require "barra.php"?>
        </div>
        <div id="main">
            <section>
                <article>
                    <h2><?php echo $fila["nombre"] ?></h2>
                    <p>
                        <b>Numero de pujas: </b><?php echo $fila["cont"] ?> -
                        <b>Precio actual: </b><?php $precio = $fila["precio_actual"] != null ? $fila["precio_actual"] : $fila["preciopartida"] ;
                        echo number_format($precio, 2, ",", ".") . "€";?> -
                        <b>Fecha fin para pujar: </b> <?php echo date_format(date_create($fila["fechafin"]),"d/m/Y H:i:s") ?>
                        <p>
                            <?php 
                                $imgs = "select imagen from imagenes where id_item = $id";
                                $resul_img = $conn -> query($imgs);
                                if($conn->errno) die($conn->error);
                                while($img = $resul_img -> fetch_assoc()){
                                    echo "<img src='".IMAGENES."/".$img["imagen"]."' width='150rem'>";
                                }
                            ?>
                        </p>
                        <p><?php echo $fila["descripcion"] ?></p>
                    </p>
                </article>
                <?php 
                    $_SESSION["ultima_pagina"] = "itemdetalles.php?id=$id";
                    if(!isset($_SESSION["id_usuario"])): 
                ?>
                    <article>
                        <h2>Pujar por este item</h2>
                        <p>Para pujar debes autentificarte.<a href='login.php'>Aqui</a></p>
                    </article>
                <?php else:?>
                    <article>
                        <h2>Pujar por este item</h2>
                        <p>Añade tu puja en el cuadro inferior: </p>
                        <?php
                            $fecha  = getdate();
                            $fecha = $fecha["year"]  . "-".$fecha["mon"] ."-".$fecha["mday"];
                            $user = $_SESSION["id_usuario"];
                            $mensaje_error = mensajeError($conn,$id,$user,$fecha);
                            if(strcmp($mensaje_error,"")==0 && !empty($_POST["puja"])){
                                $precio = floatval($_POST["puja"]);
                                $sql_insertar = "INSERT INTO `pujas`(`id_item`, `id_User`, `cantidad`, `fecha`) VALUES ('$id','$user','$precio','$fecha')";
                                $conn->query($sql_insertar);  
                                if($conn->errno) die($conn->error);                       
                            }
                        ?>
                        <form action="<?php echo  $_SESSION["ultima_pagina"] ?>" method="post">
                            <table>
                                <tr>
                                    <td><input type="text" name="puja" id="puja"></td>
                                    <td><input type="submit" name="pujar" value="¡Puja!"><?php echo $mensaje_error ?></td>
                                </tr>
                            </table>
                        </form>
                    </article>
                    <article>
                        <h2>Historial de la puja</h2>
                        <ul>
                            <?php 
                                $sql_pujas = "SELECT cantidad,(Select nombre from usuarios u where p.id_User = u.id) user FROM pujas p WHERE id_item = $id order by fecha DESC, cantidad DESC";
                                $resul_pujas = $conn -> query($sql_pujas);
                                if($conn -> errno) die($conn->error);
                                while($puja = $resul_pujas -> fetch_assoc()){
                                    echo "<li>".$puja["user"] ."- ". number_format($puja["cantidad"], 2, ",", ".") . "€"."</li>";
                                }
                            ?>
                        </ul>
                    </article>
                <?php endif;?>
                <?php
                    function mensajeError($conn,$id,$user_id,$fecha){
                        if(isset($_POST["pujar"]) && !empty($_POST["puja"])){
                            $sql_precio = "select max(cantidad) precio from pujas where $id = id_item";
                            $resul_precio = $conn->query($sql_precio);
                            if($conn -> errno) die($conn -> error);
                            $fila_p = $resul_precio -> fetch_assoc();
                            if(floatval($_POST["puja"]) <= floatval($fila_p["precio"])){
                                return $mensaje_error = "<span>Puja muy baja!</span>";
                            }
                            $sql_fecha = "select count(*) fecha from pujas where fecha = '$fecha' and id_item = $id and id_User = $user_id";
                            $resul_fecha = $conn -> query($sql_fecha);
                            if($conn -> errno)die($conn->error);
                            $fila_f = $resul_fecha -> fetch_assoc();
                            if(intval($fila_f["fecha"]) >=3){
                                return $mensaje_error = "<span>Limite de 3 pujas por dia!</span>";
                            }
                        }
                        return "";
                    }
                ?>
            </section>
        </div>
    </div>
</body>
</html>