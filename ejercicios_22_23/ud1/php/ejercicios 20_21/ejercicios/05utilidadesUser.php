
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
            include_once '../utilidades.inc.php';        
        ?>
    </head>
    <body>
        <?php
        
        
            
            dibujarTitulo("Probando pagina incluida ");
        
            $radio=10;
            echo "<p>El area es: ". (PIII*pow($radio, 2)) . "</p>";
            
            /*
            for ($anio=2100; $anio<=2300;$anio++){
                //$strAnio=$anio ."/1/1";
                 $strAnio=$anio;
                $tAnio=strtotime($strAnio);
                echo "<br>X:".$strAnio;
                if (date("L",$tAnio )==1)
                        echo "<br>$anio";
            }
            */
            
            
            $anio=date("Y");
            if (bisiesto($anio))
                echo "<p>$anio es bisiesto</p>";
            else
                echo "<p>$anio NO es bisiesto</p>";
            
            
            $tFinCoranavirus=strtotime($finCoronavirus);
           
            $diasQuedan=(int)(($tFinCoranavirus -time())/(60*60*24));
            echo "<p>Dias para fin coronavirus: $diasQuedan "; 
            
            
        
        ?>
    </body>
</html>
