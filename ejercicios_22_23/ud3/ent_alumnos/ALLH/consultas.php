<?php
    
    function fncIdItems($con){
    
        $sql = "SELECT id FROM items";   
        $resultado = mysqli_query($con, $sql); 

        if(mysqli_errno($con)) die(mysqli_error($con)); 
    
        if($resultado==false){
            return array();
        }else{
            return $resultado;
        }
    }
    function fncPujas($con){
    
        $sql = "SELECT cont(id_item)
                FROM pujas
                where exists
                            (select * 
                            from items
                            where id=id_item)";   
        $resultado = mysqli_query($cnn, $sql);   
        if(mysqli_errno($con)) die(mysqli_error($con)); 
    
        if($resultado==false){
            return array();
        }else{
            return $resultado;
        }
    }
?>




select imagenes.imagen,items.nombre,pujas.cantidad,items.preciopartida,pujas.fecha
from items,imagenes,pujas 
where imagenes.id_item=items.id
and pujas.id_item=items.id;