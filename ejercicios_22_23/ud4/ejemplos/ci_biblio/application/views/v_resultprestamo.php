<!-- //Recibe $prestados y $noprestados (arrays de índices con los nombres de los libros prestados/noprestados) -->

<br/><br/>

<?php

    if (count($prestados)>0)
    {
        echo "<h3>LIBROS PRESTADOS</h3>";
        foreach ($prestados as $p)
        {
            echo "<li>$p</li>";
        }
    }
    
     if (count($noprestados)>0)
    {
        echo "<h3>LIBROS NO PRESTADOS</h3>";
        foreach ($noprestados as $p)
        {
            echo "<li>$p</li>";
        }
    }
    
 ?>   

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

