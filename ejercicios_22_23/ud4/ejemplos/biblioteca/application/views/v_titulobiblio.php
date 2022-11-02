<html>
<head>
<title><?php echo $config_forumsname; ?></title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="estilos/stylesheet.css" type="text/css" />
</head>
<body>
    <div id="header">
        <h1>Biblioteca Agora</h1>
    </div>
    <div id="menu">
        <a href="index.php">Home</a>
        <?php
            if(isset($_SESSION['USERNAME']) == TRUE) {
                echo "<a href='logout.php'>Logout</a>";
            }
            else {
                echo "<a href='login.php'>Login</a>";
            }
        ?>
        <a href="newitem.php">New Item</a>
    </div>
    <div id="container">
        <div id="bar">
			<?php
				//Recibe $arrayautores: array con objetos (idautor,nombre)        
				foreach ($arraygeneros as $genero){
					$nombreGenero=$genero['genero'];
					//TODO - modificar enlaces para la carga de libros por genero
					echo "<p><a href='".  site_url()."/clibros/$nombreGenero/'>".$nombreGenero."</a></p>";
				}
			?>
        </div>
        <div id="main">
		<h3 bgcolor="#CCCCCC">BIBLIOTECA AGORA( <?= $mensaje ?> )  </h3>

