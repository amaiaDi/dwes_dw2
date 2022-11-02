<?php require("cabecera.php"); ?> 
<?php
    $id=$_GET['id'];
    $nombre=$_GET['nombre'];
    $precio = preciopuja($id);
    if(isset($_POST['dinero'])){
        $nombre = $_SESSION['nombre'];
        $dinero = $_POST['dinero'];
        if($dinero <= $precio){
            echo "<h1 class='rojo'>Cantidad muy baja</h1>";
        }
        else{
            if(pujasHoy($id) > 2){
                echo "<h1 class='rojo'>Demasiadas pujas hoy</h1>";
            }
            else {
                nuevaPuja($id, $nombre, $dinero);
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <h1>
        <?php 
            $nombre=$_GET['nombre'];
            echo $nombre;
        ?>
    </h1>
    <?php 
        $id=$_GET['id'];
        $nombre=$_GET['nombre'];
        $cuantaspujas=cuantasPujas($id);
        $precio= preciopuja($id);
        $fecha=fechaMaxima($nombre);
        $eu=MONEDA_LOCAL;
        echo "<h2>Numero de pujas=$cuantaspujas - Precio actual=$precio$eu - Fecha final=$fecha</h2>";
        $array=fotos($id);
        foreach($array as $arr){
            echo "<img src='img/$arr'/ class='imgdetalle'>'";
        }
        $detalles=detalles($nombre);
        echo "<h3>$detalles</h3>";
    ?>
    <h1>Puja por este item</h1>
    <?php
        if(isset($_SESSION['nombre'])){
            ?>
            <form action=<?php echo "itemdetalles.php?nombre=$nombre&id=$id";?> method="post">
            <table>
                <tr>
                    <td><input type="text" name="dinero"></td>
                    <td><input type="submit" value="PUJA" name="puja"></td>
                </tr>
            </table>
        </form>
        <h2>Historial de la puja</h2>   
    <?php
        }
        else{
            echo "<p>Para pujar, debes autentificarte. <a href='login.php'>aqui</a></p>";
        }

    ?>
    

<?php require("pie.php"); ?>
</body>
</html>