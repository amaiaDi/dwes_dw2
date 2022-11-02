<?php

require("config.php");

$db = mysqli_connect($dbhost, $dbuser, $dbpassword);
mysqli_select_db($dbdatabase, $db);

$validimageid = $_GET['image_id'];
$validitemid = $_GET['item_id'];


if($_POST['submityes']) {
    $imagesql = "SELECT imagen FROM imagenes WHERE id = " . $validimageid;
    $imageresult = mysqli_query($db,$imagesql);
    $imagerow = mysqli_fetch_assoc($imageresult);
    unlink("./imagenes/" . $imagerow['imagen']);
    $delsql = "DELETE FROM imagenes WHERE id = " . $validimageid;
    mysqli_query($db,$delsql);
//    echo "borrada";
//    exit();
    header("Location: " . $config_basedir. "addimages.php?id=" . $validitemid);
}

elseif($_POST['submitno']) {
    header("Location: " . $config_basedir . "addimages.php?id=". $validitemid);
}
else {
    require("header.php");
    ?>


    <h2>Borrar imagen?</h2>
    <?php $destino=$_SERVER['PHP_SELF']."?image_id=".$validimageid."&item_id=" .$validitemid;    ?>
    <form action=<?php  echo $destino; ?> method="post">
        ¿Realmente deseas borrar esta imagen?
        <p>
            <input type="submit" name="submityes" value="SI">
            <input type="submit" name="submitno" value="No">
        </p>
    </form>

    <?php
    }

?>