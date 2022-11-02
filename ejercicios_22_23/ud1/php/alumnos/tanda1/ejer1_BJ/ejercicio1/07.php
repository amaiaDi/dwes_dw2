<?php
    $archivo = fopen("7.txt", "r");
    while (!feof($archivo)) {
        $linea = fgets($archivo);
        $partes=explode(" ",$linea);
        echo "<a href=$partes[0]>$partes[1]</a>";
        echo "<br>";
    }
    fclose($archivo);
?>