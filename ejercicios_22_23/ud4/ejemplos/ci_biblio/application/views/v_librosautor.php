<!-- Le llega:
       arraylibros:array de arrays (cada subarray(libro)
                                      //tiene idlibro, titulo, paginas, genero
-->

<?php
    
    echo "<ul>";
    foreach ($arraylibros as $libro)
    {
        echo "<li><b>".$libro['titulo']."</b>, " . $libro['paginas']." páginas. ". $libro['genero']."</li>";
    }
    echo "</ul>";





/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

