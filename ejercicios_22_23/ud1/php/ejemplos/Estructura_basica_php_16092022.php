<html>
    <head>
        <title> Estructura basica 2</title>
        <?php include 'definiciones.php';
        include 'programa.php';
        ?>
    </head>
    <body>
    
    <body>
        <!-- Tantos bloques de codigo como sean necesarios. 
        La definición en bloques previos puede usarse en los posteriores -->
        <?php $a=1; ?>
        <p>Página de pruebas</p></br>

        <p><?php echo("valor variable a:").$a?></p></br>

        <?php $b=$a; ?>
        <p><?php print("valor variable b:").$b?></p></br>

        <!-- Tantos bloques de codigo como sean necesarios.  -->
        <?php
            // $_modulo=”DWES”;
            // print "<p>Módulo: $_modulo</p></br>";

            $_modulo2='DDBB';
            print "<p>Módulo: $_modulo2</p></br>";
            print "<p>Módulo: \'$_modulo2\'</p></br>";
            print "<p>Módulo: \"DWES\"</p></br>";
            print "<p>Módulo: 'DWES'</p></br>";

        ?>
        <!-- Si necesitamos concatenar texto detras del valor de una variable deberemos indicar que se trata de la variable entre {} -->
        <?php
            $var = "way";
            echo "Two $vars to define a variable";
        ?>
        </br>
        <?php
            $var = "way";
            echo "Two {$var}s to define a variable ";
        ?>
        <!-- Herramientas de concatenacion de textos  -->
        <?php
            $a = "Módulo ";
            $b = $a . "DWES"; // ahora $b contiene "Módulo DWES";
            print "<p>Valor variable a : $a,  valor variable b: $b</p></br>";
            $a .= "DWES"; // ahora $a también contiene "Módulo DWES";
            print "<p>Valor variable a : $a,  valor variable b: $b</p></br>";
        ?> 

        <!-- Sentencias de salto -->
        <?php
            $a = 1;
            goto salto;
            $a++;  //esta sentencia no se ejecuta
            salto:
            echo $a."</br>";  // el valor obtenido es 1
        ?>

        <!-- Sentencias condicionales -->
        <?php
            if ($a < $b)
                print "a es menor que b";
            elseif ($a > $b)
                print "a es mayor que b";
            else
                print "a es igual a b";
        ?>

        <!-- Funciones -->


        <?php 
    
            function media_aritmetica($a, $b) 
            { 
                $media=($a+$b)/2; 
                return $media; 
            } 
            echo media_aritmetica(4,6)."<br>";    
            
            
	
            function verPelicula($titulo ){
                return "Vas a ver la película $titulo" . "<br>";
            }
            echo verPelicula("Avatar");
            echo verPelicula("Braveheart");


            $modulos = array("PR" => "Programación", "BD" => "Bases de datos",  "DWES" => "Desarrollo servidor");
            foreach ($modulos as $codigo => $modulo) {
                print "El código del módulo ".$modulo." es ".$codigo."<br />";
            }
            

        ?>


    </body>
</html>