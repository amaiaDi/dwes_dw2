la <?php include("rutas_config.php"); 
//$this->load->helper("rutas_config");

?>   
<!DOCTYPE html>
<html>
<head>
    <title>BIBLIOTECA AGORA</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="<?php echo $ruta_estilos ?>stylesheet.css" type="text/css" />
</head>
<body>    
    <div id="header">
        <h1>PRESTAMOS</h1>
    </div>    
    <div id="container">
     <div id="bar">       
        <?php 
            //$generos: Arrays de objetos (cada objeto tiene genero)
        
            echo "<ul>";            
            foreach ($generos as $genero)
            {
                $strgenero=$genero->genero;
                $enlace=site_url()."/c_prestamos/librosgenero/$strgenero";                
                echo "<li><a href='$enlace'>$strgenero</a></li>";
            }
            
            echo "</ul>";
        
        ?>
    </div>
    <div id="main">
 