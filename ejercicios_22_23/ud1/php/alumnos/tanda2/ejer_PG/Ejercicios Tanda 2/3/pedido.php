<!DOCTYPE html>
<html>
    <style>
        .pf{
            background-color:gray;
            text-align:center;
        }
    </style>
<body>

<?php

$handle = fopen("../ficheros/articulos.txt", "r");
$total=0;
if(isset($_GET["precio"])){
    if($_GET["precio"]!=0){
        $total=$_GET["total"]+$_GET["precio"];
        $_GET["total"]=$total;
    }
}
print "<table><tr><td colspan='3' class='pf'>Elegir tu pedido</td></tr>";
$linea = fgets($handle);

while(!feof($handle)){
    print"<tr>";
    $nom = strchr($linea,";",1);
    $pre = substr(strchr($linea,";"),1);
    print"<td>$nom</td><td>$pre €</td><td><a href='pedido.php?precio=$pre&total=$total'>añadir al carro</a></td></tr>";
    $linea = fgets($handle);
    }
    fclose($handle);
    
    
    
    print "<tr><td colspan='3' class='pf'>Total:$total €</td></tr>";
print "</table>";


//añadir

if(isset($_POST["anadir"])=="b"){
    if ($_POST["nombre"]!="" && $_POST["precio"]!=""){
        print $_POST["anadir"];
        $anadir = fopen("../ficheros/articulos.txt", "a");
        fgets($anadir);
        fwrite($anadir, $_POST["nombre"].";".$_POST["precio"].PHP_EOL);
        fclose($anadir);
        $_POST["nombre"]="";
        $_POST["precio"]="";
        header("Location: pedido.php");
    }
}

?>
    <form action='pedido.php' method='post'>
        <table>
            <tr>
                <td colspan='3' class='pf'>Añadir Articulo</td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td>Precio(€)</td>
                <td></td>
            </tr>
            <tr>
                <td><input type='text' id='nombre' name='nombre'></td>
                <td><input type='number' id='precio' name='precio'></td>
                <td><button type="submit" name="anadir" value="b" id="anadir">Añadir</button></td>
            </tr>
        </table>
    </form>
</body>
</html>