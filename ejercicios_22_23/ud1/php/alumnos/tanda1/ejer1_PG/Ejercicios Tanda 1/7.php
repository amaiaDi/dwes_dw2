<!DOCTYPE html>
<html>
<body>

<?php
/*
    $handle = fopen("ficheros/links.txt", "r");
    while (!feof($handle)) {
        $linea = fgets($handle);

        echo "<a href='$linea'>$linea</a>"."<br>";
        }
    fclose($handle);
      */

      $handle = fopen("ficheros/links.txt", "r");
      while (!feof($handle)) {
            $linea = fgets($handle);
            $link = strstr($linea," ",true);
            $nombre = strstr($linea," ");
          echo "<a href='$link'>$nombre</a>"."<br>";
          }
      fclose($handle);
        
?>
</body>
</html>