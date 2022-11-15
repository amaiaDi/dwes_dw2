<?php
require_once "../DB/DB.php";

function addBid($item_id, $user_id, $bid_quantity, $bid_date)
{
    $conn=connectToDB();
    $queryPuja="INSERT INTO puja(id_item, id_user, cantidad, fecha) VALUES(?,?,?,?);";

    $st=$conn -> prepare($queryPuja);
    $st_prepared=$st -> bind_param("iids", $item_id, $user_id, $bid_quantity, $bid_date);
    $st_executed=$st -> execute();

    $st -> close();
    $conn -> close();
    return $st_prepared && $st_executed;
}

function getBidDataOfItem($item_id)
{
    $bidDataOfItem=[];
    $list_bidsOfItem=getBidsOfItem($item_id);
    
    $winnerUser_id=false;
    for($i=0, $bid_maxPrice=-1; $i<count($list_bidsOfItem); $i++)
    {
        $bid_quantity=$list_bidsOfItem[$i]["cantidad"];
        if($bid_quantity>$bid_maxPrice)
        {
            $bid_maxPrice=$bid_quantity;
            $winnerUser_id=$list_bidsOfItem[$i]["id_user"];
        }
    }

    $bidDataOfItem[]=count($list_bidsOfItem);
    $bidDataOfItem[]=$bid_maxPrice;
    $bidDataOfItem[]=$winnerUser_id;

    return $bidDataOfItem;
}

function getBidsOfItem($item_id)
{
    $conn=connectToDB();
    $list_bidsOfItem=[];
    $query="SELECT * FROM puja WHERE id_item=? ORDER BY cantidad DESC;";
    
    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("i", $item_id);
    $st_executed=$st -> execute();

    if($st_prepared && $st_executed) 
    {
        $st_result=$st -> get_result();
        while($item=$st_result -> fetch_assoc()) 
            $list_bidsOfItem[]=$item;
    }

    $st -> close();
    $conn -> close();
    return $list_bidsOfItem;
}

function getBidsOfUserFromToday($user_id, $bid_date)
{
    $conn=connectToDB();
    $list_bidsOfUserFromToday=[];
    $query="SELECT * FROM puja WHERE id_user=? AND fecha=?;";

    $st=$conn -> prepare($query);
    $st_prepared=$st -> bind_param("is", $user_id, $bid_date);
    $st_executed=$st -> execute();

    if($st_prepared && $st_executed) 
    {
        $st_result=$st -> get_result();
        while($item=$st_result -> fetch_assoc()) 
            $list_bidsOfUserFromToday[]=$item;
    }

    $st -> close();
    $conn -> close();
    return $list_bidsOfUserFromToday;
}
?>