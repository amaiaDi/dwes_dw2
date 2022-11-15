<?php
    session_start();
    require_once("config.php");
    require_once("funciones.php");

    //Crear conexion BD
    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($con, DB_DATABASE);
?>

<?php
    if(isset($_GET["idItem"]) && !empty($_GET["idItem"])){
        $mostrar="";
        $nombre;
        $pujas;
        $precio;
        $fechaFin;
        $imagen2;
        $descripcion;

        $item=dameItem($con, $_GET["idItem"]);
        while($fila = mysqli_fetch_assoc($item)){ 
            $nombre="<h1>".$fila['nombre']."</h1>";
            $fechaFin=$fila['fechafin'];
            $descripcion="<p>".$fila['descripcion']."</p>";
        

        //Obtener imagen del item
        $imagen=dameImagen($con, $fila['id']);
        $row_cnt_imagen = mysqli_num_rows($imagen);
        if($row_cnt_imagen==0){
            $imagen2="NO IMAGEN";
        }else{
            while($fila2 = mysqli_fetch_assoc($imagen)){ 
                $imagen2="<img width='200em' height='200em' src='".CARPETA_IMAGENES."/".$fila2["imagen"]."'>";
            }
            
        }

        //Obtener numero de pujas
        $resultadopujas=dameCantPujas($con, $fila['id']);
        $row_cnt_puja = mysqli_num_rows($resultadopujas);
        while($filapujas = mysqli_fetch_assoc($resultadopujas)){ 
            $pujas=$filapujas["TOTAL"];
        }
        //Obtener precio
        $precio="";
        if($pujas==0){
            $precio=$fila['preciopartida'];
        }else{
            $resultadoprecio=damePujaMasAlta($con, $fila['id']);
            while($filaprecio = mysqli_fetch_assoc($resultadoprecio)){ 
                $precio=$filaprecio["MAXCANTIDAD"];
            }
        }
        
        //MOSTRAR DATOS DE ITEM
        $mostrar.=$nombre."<p><strong>Número de pujas: ".$pujas." - Precio actual: ".$precio."€ - Fecha fin para pujar: ".$fechaFin."</strong></p>";
        $mostrar.=$imagen2;
        $mostrar.=$descripcion;
        $mostrar.="<h1>PUJA POR ESTE ITEM</h1>";

        if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])){
            $mostrar.="<p>Añade tu puja en el cuadro inferior:</p>";
            $mostrar.="<form action=".$_SERVER['REQUEST_URI']." method='post'>";
            $mostrar.="<table><tr>";
            $mostrar.="<td><input type='text' name='pujaItem' value=''></td>";
            $mostrar.="<td><input type='submit' value='puja' name='puja'/></td>";
            $mostrar.="</tr></table></form>";
        }else{
            $mostrar.="<p>Para pujar debes autenticarte <a style='text-decoration:none;color:black;' href='index.php?pagActual=login'>aqui</a></p>";
        }
        $mostrar.="<h1>HISTORIAL DE LA PUJA</h1><ul>";
        $resultadopujas=damePujas($con, $_GET["idItem"]);
        while($filapuja = mysqli_fetch_assoc($resultadopujas)){ 
            $mostrar.="<li>".$filapuja["USUARIO"]." - ".$filapuja["CANTIDAD"]."</li>";
        }
        $mostrar.="</ul>";
        
            // if(isset($_POST['puja'])){
            //     if(is_numeric($_POST['pujaItem'])){
            //         $valorPujado=$_POST['pujaItem'];
            //         if($valorPujado>$precio){
            //             //$mostrar.="<li>".$_SESSION['usuario']." - ".$valorPujado."€</li>";
                            //INSERTAR TUPLA EN BASE DE DATOS
            //         }else{
            //             //mensaje de error
            //         }
            //         //IF para controlar 3 pujas del mismo usuario. Guardar en session?
            //     }
            // }
            // $mostrar.="</ul>";
    }
    echo $mostrar;
    }
?>