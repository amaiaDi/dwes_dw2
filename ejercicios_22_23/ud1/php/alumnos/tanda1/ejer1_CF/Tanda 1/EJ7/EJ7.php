<?php
function showWebLinks()
{
    $webLinks=[];
    $handle=fopen("url.txt", "r");
    for($iUrl=0; !feof($handle); $iUrl++) 
    {
        $linea=fgets($handle); 
        $webLinks[$iUrl]=$linea;
    }
    fclose($handle);

    foreach($webLinks as $webLink)
    {
        $currentWeb=explode(" - ", $webLink);
        $webName=$currentWeb[0];
        $webUrl=$currentWeb[1];
        echo "<a href='$webUrl' target='_blank'>$webName</a><br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <?php showWebLinks();?>
</body>
</html>