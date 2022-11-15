<?php
require_once "../DB/DB_category.php";

drawUl_itemCategories();

function drawUl_itemCategories()
{
    $list_item_category=getItemCategories();

    $txtHTML="<h1>Categorias</h1>";
    $txtHTML.="<ul><li><a href='./index.php'>Ver todas</a></li>";
    for($i=0; $i<count($list_item_category); $i++)
    {
        $item_category=$list_item_category[$i];
        $txtHTML.="<li><a href='./index.php?item_category_id=".$item_category["id"]."'>".$item_category["categoria"]."</a></li>";    
    }
    $txtHTML.="</ul>";

    echo $txtHTML;
}
?>