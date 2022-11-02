


<?php
//$arrLibros: array de objetos con (idlibro, titulo)

            echo form_open(site_url()."/c_devoluciones/prestadosDe");  
            
            echo "Bibliotecario:";   
           
            echo form_input('username',set_value('username'));
            echo "</br></br>";  
          
            echo "Elija libro:";
           
            //LIBROS CON PRESTAMOS    
            echo "<table>";
            foreach ($arrLibros as $libro)
            {                    
                    echo "<tr><td>";    
                  
                  //MODO 1
                  //    echo form_radio("idlibro",$libro->idlibro, $this->input->post('idlibro') == $libro->idlibro);      
                  
                    //MODO2
                    echo form_radio("idlibro",$libro->idlibro,  set_checkbox("idlibro", $libro->idlibro));      
                    echo $libro->titulo;
                    echo "</td></tr>";
            }              
            echo "</table>";
            echo form_submit('submit_verprestados','VER PRESTAMOS');         
            echo form_close();
          
            echo "<font color='red'>".validation_errors()."</font>";
           
?>


