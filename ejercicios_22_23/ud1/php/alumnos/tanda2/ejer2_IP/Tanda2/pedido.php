<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRUTERIA</title>
</head>
<body>
        <?php 
             function guardarArticulos(){
                $articulos = array();
                $f= fopen('ficheros/articulos.txt', 'r' );
                if(!$f){
                     echo 'EL ARCHIVO NO EXISTE';
                }else{
                    while (!feof($f)){
                        $art = explode(";", fgets ($f));
                        if(sizeof($art)==2){
                            array_push($articulos, $art);
                        }
                       
                    }
                fclose ($f) ;
                }
                return $articulos;
            }

            function creartabla(){
                //Array para guardar los articulos del fichero
                $misArticulos=guardarArticulos();
                //Variable para color de celda
                $estilo="background-color:lightgrey;text-align:center;font-weight:bold;";

                //Comprobar si se añade producto
                if (isset($_GET['precio'])) {
                    $precio=floatval($_GET['precio']);
                } else {
                    $precio=0;
                }

                //TABLA
                $tabla="<table class='hidden'>";
                $tabla.="<caption style='$estilo'>ELIGE TU PEDIDO</caption";
                
                //Por cada uno de los articulos, añadimos a la tabla 3 columnas (4 si tiene fichero)
                foreach ($misArticulos as list($clave, $valor)) {
                    global $arrLinks;
                    $tabla.="<tr>";

                    //Añadir Producto y precio
                    $tabla.="<td>$clave</td>";
                    $tabla.="<td>$valor €</td>";

                    //Calcular precio solo cuando se pulsa el link
                    $cant=$precio+floatval($valor);
                    $tabla.="<td><a href='?precio=".$cant."' name='$valor'>Añadir unidad</a></td>";
                    
                    //Añadir fichero si existe
                    if (file_exists("ficheros/".$clave.".txt")) {
                        $tabla.="<td><a href=ficheros/".$clave.'.txt'.">Ver descripción</a></td>";
                    } 
                    
                    $tabla.="</tr>";
                }

                //TABLA
                $tabla.="<tr style='$estilo''><td colspan='3'>TOTAL: $precio €</td></tr>";
                $tabla.="</table>";
                
                return $tabla;
            }     
            
            function actualizarArticulos(){
                //Si pulsamos sobre el botón y ninguno de los campos está vacío
                if(isset($_POST["añadirProducto"])&&!empty($_POST['nombre'])&&!empty($_POST['precio'])){
                    //Añadir solo si el segundo valor es numerico
                    if(is_numeric($_POST['precio'])){
                        //La siguiente línea refresca la página
                        echo "<meta http-equiv='refresh' content='0'>";
                        echo "<strong>Se ha añadido:</strong> ".$_POST['nombre'].";".$_POST['precio']."<strong>€</strong>";
                        file_put_contents("ficheros/articulos.txt","\r\n".$_POST['nombre'].";".$_POST['precio'], FILE_APPEND);  
                    }else{
                        echo "no es numerico";
                    } 
                } 
            }
         ?>    
         <?php echo creartabla(); ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <br><br><br>
            <p style="background-color:lightgrey;font-weight:bold;display:inline-block;">AÑADE ARTICULO</p>  
            <p>NOMBRE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRECIO(€):</p>
            <input type="text" id="nombre" name="nombre">
            <input type="text" id="precio" name="precio">
            <input type="submit" value="AÑADIR" name="añadirProducto"/>
        </form>

        <?php 
            echo actualizarArticulos();        
        ?>

</body>
</html>