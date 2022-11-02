
<?php
session_start();
include("config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword);
mysqli_select_db($dbdatabase, $db);


require("header.php");

if (!isset($_GET['id'])){
        //VIENE SIN ID DEL ITEM
//        header("Location: ".$config_basedir);  
    
}
else{
        //VIENE CON ITEM NO NUMERICO
        if (!is_numeric($_GET['id']))
            header("Location: ".$config_basedir);
        else{
            $idvalido=$_GET['id'];
           $itemsql="SELECT UNIX_TIMESTAMP(fechafin) AS dateepoch,items.* FROM items WHERE id = " . $idvalido . ";";
        }
}


if(isset($_POST['submit'])) {
   
    if(!is_numeric($_POST['bid'])) {
        //HAN HECHO UNA PUJA METIENDO UN VALOR NO NUMERICO
        header("Location: " . $config_basedir. "itemdetails.php?id=" . $idvalido . "&error=letter");
        exit();
    
    }
    $theitemsql = "SELECT * FROM items WHERE id = " . $idvalido . ";";
    $theitemresult = mysqli_query($theitemsql);
    $theitemrow = mysqli_fetch_assoc($theitemresult);
    $checkbidsql = "SELECT id_item, max(cantidad) AS highestbid, count(id) AS number_of_bids FROM
                    pujas WHERE id_item=" . $idvalido . " GROUP BY id_item;";
    $checkbidresult = mysqli_query($checkbidsql);
    $checkbidnumrows = mysqli_num_rows($checkbidresult);
    if($checkbidnumrows == 0) {
        if($theitemrow['preciopartida'] > $_POST['bid']) {
            //HAN HECHO PUJA POR UNA CANTIDAD MAS BAJA A LA ULTIMA (PRECIOPARTIDA)
            header("Location: " . $config_basedir
                . "itemdetails.php?id=" . $idvalido . "&error=lowprice");
            exit();
           
        }
    }
    else {
        $checkbidrow = mysqli_fetch_assoc($checkbidresult);
        if($checkbidrow['highestbid'] > $_POST['bid']) {
             //HAN HECHO PUJA POR UNA CANTIDAD MAS BAJA A LA ULTIMA (PRECIOPARTIDA)
           
            header("Location: " . $config_basedir . "itemdetails.php?id=" .$idvalido . "&error=lowprice");
            exit();
        }
    }
    
    $inssql = "INSERT INTO pujas(id_item, cantidad, id_user) VALUES(". $idvalido. ", " . $_POST['bid']
                . ", " . $_SESSION['USERID']. ");";
    mysqli_query($inssql);
    header("Location: " . $config_basedir. "itemdetails.php?id=" . $idvalido);
}
else{
        
        
        

        $itemresult = mysqli_query($itemsql);
        $itemrow = mysqli_fetch_assoc($itemresult);
        $nowepoch = time(); 
        $rowepoch = $itemrow['dateepoch'];
        if($rowepoch > $nowepoch) { // SUBAST DEL ITEM EN VIGOR, se pueden hacer pujas
            $VALIDAUCTION = 1;
        }

        echo "<h2>" . $itemrow['nombre'] . "</h2>";
        $imagesql = "SELECT * FROM imagenes WHERE id_item = " . $idvalido . ";";
        $imageresult = mysqli_query($imagesql);
        $imagenumrows = mysqli_num_rows($imageresult);

        $bidsql = "SELECT id_item, MAX(cantidad) AS highestbid, COUNT(id) AS number_of_bids
                    FROM pujas WHERE id_item=". $idvalido . " GROUP BY id_item";
        $bidresult = mysqli_query($bidsql);
        $bidnumrows = mysqli_num_rows($bidresult);

        echo "<p>";
        if($bidnumrows == 0) {
            echo "<strong>Este item no tiene pujas</strong> - <strong>Precio de partida</strong>: "
                . sprintf('%.2f', $itemrow['preciopartida']) . $config_currency ;
        }
        else {
            $bidrow = mysqli_fetch_assoc($bidresult);

            echo "<strong>Número de pujas</strong>: ". $bidrow['number_of_bids'] . "
                - <strong>Precio actual</strong>: " . sprintf('%.2f', $bidrow['highestbid']). $config_currency;
        }

        echo " - <strong>Fecha fin para pujar</strong>: ". date("D jS F Y g.iA", $rowepoch);
        echo "</p>";


        if($imagenumrows == 0) {
            echo "SIN IMAGENES.";
        }
        else {
            while($imagerow = mysqli_fetch_assoc($imageresult)) {
                echo "<img src='./imagenes/" . $imagerow['imagen'] ."' width='70'>&nbsp&nbsp&nbsp" ;
            }
        }

        echo "<p>" . nl2br($itemrow['descripcion']) . "</p>";
        echo "<h2>Puja por este item</h2>";

        if(isset($_SESSION['USERNAME']) == FALSE) {
            echo "Para pujar, debes autenticarte.";
            //echo "<a href=login.php?id=" . $idvalido . "&ref=addbid>aquí</a>.";
            $_SESSION['REF']="addbid"; 
            echo "<a href=login.php?id=" . $idvalido .">aquí</a>";
        }

        else {
            if($VALIDAUCTION == 1) {
                echo "Añade tu puja en el cuadro inferior:";
                echo "<p>";
                if (isset($_GET['error'])){
                    switch($_GET['error']) {
                        case "lowprice":
                            echo "Puja muy baja.Mete otro precio.";
                            break;
                        case "letter":
                            echo "El valor debe ser numérico.";
                            break;
                    }
                }
        
                
                
                 $ruta=$config_basedir. "itemdetails.php?id=" . $idvalido;   
        ?>        
                <form action="<?php echo $ruta;?>" method="post">
                <table>
                <tr>
                    <td><input type="text" name="bid"></td>
                    <td><input type="submit" name="submit" value="¡Puja!"></td>
                </tr>
                </table>
                </form>
        <?php
            }
            else {
                echo "Esta subasta ya ha finalizado.";
            }

            $historysql = "SELECT pujas.cantidad, usuarios.username FROM pujas, usuarios WHERE
                pujas.id_user = usuarios.id AND id_item = ". $idvalido . " ORDER BY cantidad DESC";
            $historyresult = mysqli_query($historysql);
            $historynumrows = mysqli_num_rows($historyresult);
            if($historynumrows >= 1) {
                echo "<h2>Historial de la puja</h2>";
                echo "<ul>";
                while($historyrow = mysqli_fetch_assoc($historyresult)) {
                    echo "<li>" . $historyrow['username'] . " - " . sprintf('%.2f', $historyrow['cantidad'])
                            . $config_currency.  "</li>";
                }
                echo "</ul>";
            }
        }
}
?>

