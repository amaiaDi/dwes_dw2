<?php
#Crea un fichero de texto en una carpeta de tu proyecto que contenga url’s (una por línea).
#Haz que tu página visualice los enlaces del fichero (uno por cada url del fichero), y que enlacen a las direcciones correspondientes.
#Cuando funcione, cambia el fichero de texto de modo que cada línea contenga, además de una URL, un nombre. Cambia tu página para que en el enlace se visualice el nombre en lugar de la URL

$handle = fopen("url/url.txt", "r");
while (!feof($handle)) {
    $linea = fgets($handle); 
    echo "<br/><a href='$linea' target='about_blank'>$linea</a>";
    

}
fclose($handle);

echo "<br/><br/>";

$handle = fopen("url/url_nombre.txt", "r");
while (!feof($handle)) {
    $linea = fgets($handle); 
    $parts = explode(";",$linea);
    echo "<br/><a href='$parts[0]' target='about_blank'>$parts[1]</a>";
    

}
fclose($handle);



?>