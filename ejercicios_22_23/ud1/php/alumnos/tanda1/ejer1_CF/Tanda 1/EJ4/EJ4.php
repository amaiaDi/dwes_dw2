<?php
$imgPaths=
[
    "./img/01.jpg",
    "./img/02.jpg",
    "./img/03.jpg",
    "./img/04.jpg",
    "./img/05.jpg",
    "./img/06.jpg",
    "./img/07.jpg",
    "./img/08.jpg",
    "./img/09.jpg",
    "./img/10.jpg",
    "./img/11.jpg",
    "./img/12.jpg",
    "./img/13.jpg"
];

function drawImgTable($imgPaths)
{
    $imgPaths_noDuplicates=[];
    $txtHtml="<table><tr>";
    $endOfRow=false;
    for($i=0, $contImg=0; $i<count($imgPaths); $i++)
    {
        $img=$imgPaths[$i];
        $md5=md5_file($img, true);
        if(!in_array($md5, $imgPaths_noDuplicates))
        {
            $imgPaths_noDuplicates[count($imgPaths_noDuplicates)]=$md5;
            $txtHtml.="<td><a target='_blank' href='".$img."'>"
            . "<img src='".$img."' style='object-fit:cover' width='100' height='100'></img>"
            . "</a></td>";

            if(++$contImg%3==0)
            {
                $txtHtml.="</tr>";
                $endOfRow=true;
            }
            else 
                $endOfRow=false;
        }
    }

    if($endOfRow==false)
        $txtHtml.="</tr></table>";
    else 
        $txtHtml.="</table>";
    echo $txtHtml;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php drawImgTable($imgPaths);?>
</body>
</html>