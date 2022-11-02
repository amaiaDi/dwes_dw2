<?php
require_once "../DB/DB.php";

function getItemCategories()
{
    $conn=connectToDB();
    $itemCategories=[];
    $query="SELECT * FROM categoria ORDER BY categoria ASC;";
    
    $st=$conn -> prepare($query);
    $st_executed=$st -> execute();

    if($st_executed) 
    {
        $st_itemCategories=$st -> get_result();
        while($itemCategory=$st_itemCategories -> fetch_assoc()) 
            $itemCategories[]=$itemCategory;
    }

    $st -> close();
    $conn -> close();
    return $itemCategories;
}
?>