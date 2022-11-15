<?php 
//RECIBIR

function damePujas($con, $idItem){
    $sql= "SELECT username as USUARIO, cantidad as CANTIDAD FROM usuarios, pujas WHERE id_user=usuarios.id AND id_item=$idItem";
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

function dameItem($con, $idItem){
    $sql = "SELECT * FROM items WHERE id=$idItem";   
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

function dameUsername($con){
    $sql = "SELECT username FROM usuarios";   
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

function dameUsuarios($con){
    $sql = "SELECT * FROM usuarios";   
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

 function dameCategorias($conn){
    $sql = "SELECT categoria FROM categorias";   
    $resultado = mysqli_query($conn, $sql);   
    if(mysqli_errno($conn)) die(mysqli_error($conn)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

function dameIDCategorias($conn, $nombreCategoria){
   $sql = "SELECT id FROM categorias where categoria='$nombreCategoria'";   
   $resultado = mysqli_query($conn, $sql);   
   if(mysqli_errno($conn)) die(mysqli_error($conn)); 
   if($resultado==false)
       return array();
   else
      return $resultado;
}

function establecerCategoria($con){
    //Recibir ID de la categoria
    $idCategoria="";
    if(isset($_GET["id"])){
        $idCategoria=$_GET["id"];
    }
    
    //Establecer select de los items según ID de categoria
    $sql;
    if($idCategoria==""){
        $sql= "SELECT * from items";
    }else{
        $sql= "SELECT * from items where id_cat='$idCategoria'";
    }
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}    

function dameImagen($con, $idItem){
    $sql = "SELECT imagen FROM imagenes where id_item='$idItem'";   
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

function dameCantPujas($con, $idPuja){
    $sql = "SELECT count(*) as TOTAL from pujas where id_item=$idPuja";   
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

function damePujaMasAlta($con, $idItem){
    $sql = "SELECT max(cantidad) as MAXCANTIDAD from pujas where id_item=$idItem";   
    $resultado = mysqli_query($con, $sql);   
    if(mysqli_errno($con)) die(mysqli_error($con)); 
    if($resultado==false)
        return array();
    else
       return $resultado;
}

//MOSTRAR

function existeUsername($con, $username){
    $resultado=dameUsername($con);
    while($fila = mysqli_fetch_assoc($resultado)){ 
        if($fila["username"]==$username)
        return true;
    }
    return false;
}

function mostrarCategoriasSelect($con){
    $mostrarCategorias="";
    $resultado=dameCategorias($con);
    if (isset($resultado)){ 
        $mostrarCategorias.= "<select name='selectCategoria'>";
    while($fila = mysqli_fetch_assoc($resultado)){ 
            $mostrarCategorias.="<option value=".$fila['categoria'].">".$fila['categoria']."</option>";
    }      
    $mostrarCategorias.= "</select>";
    }
    return $mostrarCategorias;
}

function mostrarCategoriasUl($con){
    $mostrarCategorias="";
    $resultado=dameCategorias($con);
    if (isset($resultado)){ 
        $mostrarCategorias.= "<ul name='todasCategorias'><li><a href='index.php'>Ver todas</a></li><br>";
    while($fila = mysqli_fetch_assoc($resultado)){ 
    $id=dameIDCategorias($con, $fila["categoria"]);
    while($cID = mysqli_fetch_assoc($id)){
        $mostrarCategorias.="<li><a href='index.php?id=".$cID['id']."'>".$fila["categoria"]."</a></li><br>";
    }        
    }      
    $mostrarCategorias.= "</ul>";
    }
    return $mostrarCategorias;
}

function crearTablaItems($con){
    $crearTabla="";
    $resultado=establecerCategoria($con);
    if (isset($resultado)){ 
    while($fila = mysqli_fetch_assoc($resultado)){ 
        //Obtener imagen del item
        $imagen=dameImagen($con, $fila['id']);
        $row_cnt_imagen = mysqli_num_rows($imagen);
        if($row_cnt_imagen==0){
            $imagen2="NO IMAGEN";
        }else{
            while($fila2 = mysqli_fetch_assoc($imagen)){ 
                $imagen2="<img width='100em' height='100em' src='".CARPETA_IMAGENES."/".$fila2["imagen"]."'>";
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

        //CREAR TABLA
        $crearTabla.="<tr>";
        $crearTabla.="<td>$imagen2</td>";
        $crearTabla.="<td><a href='index.php?pagActual=itemdetalles&idItem=".$fila['id']."'>". $fila['nombre'] ."</a></td>";
        $crearTabla.="<td>$pujas</td>";
        $crearTabla.="<td>$precio</td>";
        $crearTabla.="<td>".$fila['fechafin']."</td>";
        $crearTabla.= "</tr>";
    }
    }
    return $crearTabla;
}


?>