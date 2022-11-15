<?php
require_once "../DB/DB.php";

function addItem($category_id, $user_id, $item_name, $item_price, $item_desc, $item_endDate)
{
    $conn=connectToDB();
    $query="INSERT INTO item(id_cat, id_user, nombre, preciopartida, descripcion, fechafin) VALUES(?,?,?,?,?,?);";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("iisdss", $category_id, $user_id, $item_name, $item_price, $item_desc, $item_endDate);
    $st_executed=$st -> execute();
    
    $result=false;
    if($st_prepared && $st_executed)
        $result=$conn -> insert_id;
        
    $st -> close();
    $conn -> close();
    return $result;
}

function deleteItem($item_id)
{
    $conn=connectToDB();
    $query_item="DELETE FROM item WHERE id=?";
    $query_image="DELETE FROM imagen WHERE id_item=?";
    $query_bid="DELETE FROM puja WHERE id_item=?";
   
    $st=$conn -> prepare($query_item);
    $st_prepared_item=$st -> bind_param("i", $item_id);
    $st_executed_item=$st -> execute();

    if($st_prepared_item && $st_executed_item)
    {
        $st=$conn -> prepare($query_image);
        $st_prepared_image=$st -> bind_param("i", $item_id);
        $st_executed_image=$st -> execute();
    
        if($st_prepared_image && $st_executed_image)
        {
            $st=$conn -> prepare($query_bid);
            $st_prepared_bid=$st -> bind_param("i", $item_id);
            $st_executed_bid=$st -> execute();

            $st -> close();
            $conn -> close();
            return $st_prepared_bid && $st_executed_bid;
        }
    }

    $st -> close();
    $conn -> close();
    return false;
}

function getCloseToExpirationItems()
{
    $conn=connectToDB();
    $list_itemCloseToExpiration=[];

    // Se seleccionan los items cerca de expirar (vigencia menor a 3 días). 
    // No tienen pujas, o bien la puja más alta no supera el 10% del valor inicial.
    $query="
    SELECT *
    FROM item 
    WHERE TIMESTAMPDIFF(DAY, fechafin, now()) < 3
    AND TIMESTAMPDIFF(DAY, fechafin, now()) > -3
    AND
    (
        EXISTS
        (
            SELECT *
            FROM puja
            WHERE puja.id_item = item.id
            HAVING item.preciopartida*1.1 > max(puja.cantidad)
        )
        OR NOT EXISTS
        (
            SELECT *
            FROM puja
            WHERE puja.id_item = item.id
        )
    );";

    
    $st=$conn -> prepare($query);
    $st_executed=$st -> execute();
    
    if($st_executed) 
    {
        $st_result=$st -> get_result();
        while($item=$st_result -> fetch_assoc()) 
            $list_itemCloseToExpiration[]=$item;
    }

    $st -> close();
    $conn -> close();
    return $list_itemCloseToExpiration;
}

function getExpiredItems()
{
    $conn=connectToDB();
    $list_expiredItem=[];
    
    $query="SELECT * FROM item WHERE TIMESTAMPDIFF(SECOND, fechafin, now()) > 1;";

    $st=$conn -> prepare($query);
    $st_executed=$st -> execute();
    
    if($st_executed) 
    {
        $st_result=$st -> get_result();
        while($item=$st_result -> fetch_assoc()) 
            $list_expiredItem[]=$item;
    }

    $st -> close();
    $conn -> close();
    return $list_expiredItem;
}

function getItemById($item_id)
{
    $conn=connectToDB();
    $result_item="";
    $query="SELECT * FROM item WHERE id=?;";

    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("i", $item_id);
    $st_executed=$st -> execute();
    
    if($st_prepared && $st_executed) 
    {
        $st_result=$st -> get_result();
        if($item=$st_result -> fetch_assoc()) 
            $result_item = $item;
    }

    $st -> close();
    $conn -> close();
    return $result_item;
}

function getItemsOfCategory($category_id)
{
    $conn=connectToDB();
    $list_itemOfCategory=[];
   
    $st_prepared=true;
    if($category_id == "") 
    {
        $query="SELECT * FROM item ORDER BY nombre ASC;";
        $st=$conn -> prepare($query);
    } 
    else                    
    {
        $query="SELECT * FROM item WHERE id_cat=? ORDER BY nombre ASC;";
        $st=$conn -> prepare($query);
        $st_prepared=$st -> bind_param("i", $category_id);
    }
    $st_executed = $st -> execute();
    
    if($st_prepared && $st_executed) 
    {
        $st_result=$st -> get_result();
        while($item=$st_result -> fetch_assoc()) 
            $list_itemOfCategory[]=$item;
    }
    
    $st -> close();
    $conn -> close();
    return $list_itemOfCategory;
}

function setEndDateOfItem($item_id, $item_endDate)
{
    $conn=connectToDB();
    $query="UPDATE item SET fechafin = ? WHERE id = ?;";
                
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("si", $item_endDate, $item_id);
    $st_executed=$st -> execute();

    $st -> close();
    $conn -> close();
    return $st_prepared && $st_executed;
}

function setPriceOfItem($item_id, $item_price)
{
    $conn=connectToDB();
    $query="UPDATE item SET preciopartida = ? WHERE id = ?;";
            
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("di", $item_price, $item_id);
    $st_executed=$st -> execute();
    
    $st -> close();
    $conn -> close();
    return $st_prepared && $st_executed;
}
?>