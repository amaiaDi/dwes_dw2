<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>
 <?php
var_dump(php_ini_loaded_file(), php_ini_scanned_files());?>

 <?php echo '<p>Hola Mundo</p>'; 


 if(1==1){
    echo '<p>Hola Mundo1</p>';
    echo '<p>Hola Mundo2</p>';
 }else{
    echo '<p>Hola Mundo3</p>';
    echo '<p>Hola Mundo4</p>';
 }

 ?>
 </body>
</html>