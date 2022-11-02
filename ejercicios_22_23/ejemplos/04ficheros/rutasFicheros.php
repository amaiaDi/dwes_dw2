
<?php
print_r($_FILES)."<br />";
 
echo $_SERVER['DOCUMENT_ROOT']."<br />";
//D:/Program Files (x86)/Apache Software Foundation/PHPWorkspace
 
echo __FILE__."<br />";
//D:\Program Files (x86)\Apache Software Foundation\PHPWorkspace\Test\Test\index.php
 
 // La función basename (ruta, sufijo) devuelve la parte del nombre del archivo de la ruta.
 // ruta: requerida. Especifica la ruta a verificar.
 //Sufijo (opcional. Especifica la extensión del archivo. Si el archivo tiene sufijo, esta extensión no se generará.
echo basename(__FILE__)."<br />";
//index.php
 
echo basename(__FILE__, '.php')."<br />";
//index
 
echo dirname(__FILE__)."<br />";
//D:\Program Files (x86)\Apache Software Foundation\PHPWorkspace\Test\Test
 
 // La función dirname (ruta) devuelve la parte del directorio de la ruta. El parámetro de ruta es una cadena que contiene la ruta completa a un archivo. Esta función devuelve el nombre del directorio después de eliminar el nombre del archivo.
echo dirname(dirname(__FILE__))."<br />";
//D:\Program Files (x86)\Apache Software Foundation\PHPWorkspace\Test


$elemento="Rindex.php";
print_r($_FILES)."<br />";
 
echo $_SERVER['DOCUMENT_ROOT']."<br />";
//D:/Program Files (x86)/Apache Software Foundation/PHPWorkspace
 
echo $elemento."<br />";
//D:\Program Files (x86)\Apache Software Foundation\PHPWorkspace\Test\Test\index.php
 
 // La función basename (ruta, sufijo) devuelve la parte del nombre del archivo de la ruta.
 // ruta: requerida. Especifica la ruta a verificar.
 //Sufijo (opcional. Especifica la extensión del archivo. Si el archivo tiene sufijo, esta extensión no se generará.
echo basename($elemento)."<br />";
//index.php
 
echo basename($elemento, '.php')."<br />";
//index
 
echo dirname($elemento)."<br />";
//D:\Program Files (x86)\Apache Software Foundation\PHPWorkspace\Test\Test
 
 // La función dirname (ruta) devuelve la parte del directorio de la ruta. El parámetro de ruta es una cadena que contiene la ruta completa a un archivo. Esta función devuelve el nombre del directorio después de eliminar el nombre del archivo.
echo dirname(dirname($elemento))."<br />";
//D:\Program Files (x86)\Apache Software Foundation\PHPWorkspace\Test
echo "</br>";

echo "\nEste script se ejecuta en: " . __DIR__;
$padre = dirname(__DIR__);
echo "\nLa ruta del padre es: $padre";
$masArriba = dirname($padre);
echo "\nUna ruta más arriba es: $masArriba";
echo "</br>";
$flamenco = dirname("img/flamenco.jpg");
$flamenco = dirname(".");
echo "\nUna ruta flamenco es: $flamenco";

?>