<html>
    <head>
        <title> Titulo de pagina</title>
   
    </head>
    <body>
    
        <!-- comentario de tipo hatml fuera de la etiqueta php -->


        <?php
            // comentario dentro de php
            # comentario 3
            /*
                grupo de comentarios
                de varias lineas
            */

             echo "Hola Visitante";
             echo "</br>";
            
            //  VARIABLES

            //  Asignación variables
            $mi_variable = 7; 
            echo nl2br("mi_variable es $mi_variable \n");
            echo "";

            $mi_variable = "siete"; 
            echo "mi_variable es $mi_variable  \n ";
            echo "prueba de salto de linea \n";

            // Definición variables
            $mi_booleano = false;
            $mi_entero = 3;   
            $mi_real = 7.3;
            $mi_cadena = 'cadena';
            $mi_frase = "mi_variable es";
            $mi_variable = NULL; 


            $mi_entero = 3;
            $mi_real = 2.3;
            $resultado = $mi_entero + $mi_real;
            // La variable $resultado es de tipo real 
            echo("</br>");
            echo nl2br("La variable resultado es $resultado y es de tipo real  \n");
            $resultado2 = $mi_real+$mi_entero;
        
        ?>
        

    </body>
</html>