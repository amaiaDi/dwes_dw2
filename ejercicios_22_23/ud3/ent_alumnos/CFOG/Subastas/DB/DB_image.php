<?php
require_once "../DB/DB.php";

function addImage($item_id, $item_image_path)
{
    $conn=connectToDB();
    $query="INSERT INTO imagen(id_item, imagen) VALUES(?,?);";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("is", $item_id, $item_image_path);
    $st_executed=$st -> execute();
    
    $st -> close();
    $conn -> close();
    return $st_prepared && $st_executed;
}

function deleteImage($item_id, $item_image_path)
{
    $conn=connectToDB();
    $f="../images/".$item_image_path;
    unlink($f);

    $query="DELETE FROM imagen WHERE id_item=? AND imagen=?;";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("is", $item_id, $item_image_path);
    $st_executed=$st -> execute();
    
    $st -> close();
    $conn -> close();
    return $st_prepared && $st_executed;
}

function getImageOfItem($item_id)
{
    $conn=connectToDB();
    $imageOfItem="NA";

    $query="SELECT * FROM imagen WHERE id_item=?;";
    $st=$conn -> prepare($query);
    $stPrepared=$st -> bind_param("i", $item_id);
    $stExecuted=$st -> execute();

    if($stPrepared && $stExecuted) 
    {
        $stResult=$st -> get_result();
        if($item = $stResult -> fetch_assoc()) 
            $imageOfItem=DIR_IMAGES.$item["imagen"];
    }

    $st -> close();
    $conn -> close();
    return $imageOfItem;
}

function getImagesOfItem($item_id)
{
    $conn=connectToDB();
    $list_imageOfItem=[];

    $query="SELECT * FROM imagen WHERE id_item=?;";
    $st=$conn -> prepare($query);
    $stPrepared=$st -> bind_param("i", $item_id);
    $stExecuted=$st -> execute();

    if($stPrepared && $stExecuted) 
    {
        $stResult=$st -> get_result();
        while($item = $stResult -> fetch_assoc()) 
            $list_imageOfItem[]=$item["imagen"];
    }

    $st -> close();
    $conn -> close();
    return $list_imageOfItem;
}
?>