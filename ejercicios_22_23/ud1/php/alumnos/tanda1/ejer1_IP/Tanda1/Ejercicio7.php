<?php
//Crear función
function abrirFichero($nombreFichero){
$handle = fopen($nombreFichero, "r");
while (!feof($handle)) {
    $linea = fgets($handle);  
    $nombre = substr($linea, 0, stripos($linea, " "));
    $link = substr($linea, stripos($linea, " "));
    echo "<a href='$link'>$nombre</a><br>"; 
    //Fichero solo una ruta
    //echo "<a href='$linea'>$linea</a><br>";  

}
fclose($handle);
}
?>
<?php
//Fichero
abrirFichero("fichero/rutas.txt");
?>
