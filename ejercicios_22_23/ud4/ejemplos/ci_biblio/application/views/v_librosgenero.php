<?php

         
              //$libros: Devuelve array de objetos con (idlibro,titulo, paginas,autor)
            
              echo form_open(site_url()."/c_prestamos/prestar");  //Por POST check_libros y submit_prestar
              echo "<table>";
              echo "<tr><th></th><th>LIBRO</th><th>AUTOR</th></tr>";
              foreach ($libros as $libro)
              {
                  echo "<tr>";
                  echo "<td>";
                  echo form_checkbox('check_libros[]',$libro->idlibro);
                  echo "</td>";
                  echo "<td>".$libro->titulo. "</td>";
                  echo "<td>(".$libro->autor. ")</td>";
                  echo "</tr>";
                
                  
              }  
              echo form_hidden('genero',$libro->genero);
              echo "<tr><td colspan='3'>";
              echo form_submit('submit_prestar','PRESTAR LIBROS');
              echo "</td></tr>";
              echo "</table>";
              echo form_close();
           //   echo form_checkbox('check_esp[]',$esp->idespacio, in_array($esp->idespacio,$ids_espacios_asignados )); 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

