
<?php
session_start();
include("config.php");

$db = mysqli_connect($dbhost, $dbuser, $dbpassword);
mysqli_select_db($dbdatabase, $db);

//$validid = pf_validate_number($_GET['id'], "redirect", "index.php");
if (!isset($_GET['id'])){
//VIENE SIN ID DEL ITEM
        header("Location: ".$config_basedir);  
}
else{
        //VIENE CON ITEM NO NUMERICO
        if (!is_numeric($_GET['id']))
            header("Location: ".$config_basedir);
        else{
            $idvalido=$_GET['id'];
        }
}

if(!isset($_SESSION['USERNAME'])) {
    $_SESSION['REF']="images";  
    header("Location: " . $config_basedir. "login.php?id=" . $idvalido);
    
}

//COMPROBAR QUE ESTA CON UN ITEM PROPIEDAD DEL USUARIO ACTUAL
$theitemsql = "SELECT id_user FROM items WHERE id = " . $idvalido . ";";
$theitemresult = mysqli_query($db,$theitemsql);
$theitemrow = mysqli_fetch_assoc($theitemresult);

if($theitemrow['id_user'] != $_SESSION['USERID']) {
    header("Location: " . $config_basedir);
}

if($_POST['submit']) {
    
        if (!is_uploaded_file($_FILES['userfile']['tmp_name'])){
             header("Location: " . $_SERVER['PHP_SELF']. "?id=" . $idvalido . "&error=nophoto");
        }
        else {
       
            $uploadfile =  "imagenes/". $_FILES['userfile']['name'];

            if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)) {
                $inssql = "INSERT INTO imagenes(id_item, imagen) VALUES
                        (" . $idvalido . ", '" . $_FILES['userfile']['name']. "')";
                mysqli_query($db,$inssql);
                header("Location: " . $_SERVER['PHP_SELF']. "?id=" . $idvalido);
            }
            else {
                echo 'Problema subiendo imagen al sitio.<br />';
            }
        }
}
else {
    require("header.php");
    $imagessql = "SELECT * FROM imagenes WHERE id_item = " . $idvalido;
    $imagesresult = mysqli_query($db,$imagessql);
    $imagesnumrows = mysqli_num_rows($imagesresult);

    echo "<h1>Imagenes actuales</h1>";
    if($imagesnumrows == 0) {
        echo "No hay imágenes del item.";
    }
    else {
        echo "<table>";
        while($imagesrow = mysqli_fetch_assoc($imagesresult)) {
            echo "<tr>";
            echo "<td><img src='" . $config_basedir . "/imagenes/"
                    . $imagesrow['imagen'] . "' width='100'></td>";
            echo "<td>[<a href='deleteimage.php?image_id=". $imagesrow['id'] .
                    "&item_id=" . $idvalido. "'>delete</a>]</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    if (isset($_GET['error'])){
        echo "No se ha podido subir la imagen";
    }
?>

    <form enctype="multipart/form-data" action="<?php  $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        <table>
            <tr>
                <td>Imagen a subir</td>
                <td><input name="userfile" type="file"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Subir"></td>
            </tr>
        </table>
    </form>
    Cuando termines de subir fotos, vuelve a
    <a href="<?php echo "itemdetails.php?id=". $idvalido; ?>"> ver tu item </a>!
<?php
}
?>
