<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Subastas</title>
</head>
<body>
    <h1>CATEGORIAS</h1>
    <ul>
        <li><a href='index.php'>Ver todas</a></li>
        <?php
            $mysqli = new mysqli("localhost", "marcos", "dw2", "subastas");
            
            $sql="SELECT * FROM categorias";
            $resultado=$mysqli->query($sql);
            while($dato = $resultado->fetch_assoc())   {
                echo "<li><a href='index.php?var=$dato[id]'>" . $dato["categoria"] . "</a></li>";
            }
            $resultado->free();
            $mysqli->close(); 
        ?>
    </ul>
</body>
</html>