<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi primer acercamiento a CI - Llamadas a metodos en URL</title>
</head>
<body>
    <h1>Llamadas a metodos en URL</h1>
    <h3>URL - Llamada a Metodo especifico: http://dominio.com/index.php/articulos/saludar </h3>
    <?php echo "<p><a href='".site_url()."/articulos/saludar/'>Saludar</a></p>"; ?>
    <h3>URL - Llamada a Metodo especifico con parametro: http://dominio.com/index.php/articulos/verparam/raton</h3>
        <?php echo "<p><a href='".site_url()."/articulos/verparam/raton'>Ver parametros raton</a></p>"; ?>
</body>
</html>
