

<?php
session_start();
require("config.php");

if(!isset($_SESSION['USERNAME'])) {
    
    $_SESSION['REF']="newitem";
    header("Location: " . $config_basedir . "/login.php");
    exit();
   // header("Location: " . $config_basedir . "/login.php?ref=newitem");
}

if($_POST['submit']) {
    
   
    $db = mysqli_connect($dbhost, $dbuser, $dbpassword);
    mysqli_select_db($dbdatabase, $db);
    
    $validdate = checkdate($_POST['month'], $_POST['day'],$_POST['year']);  //Función PHP
    
    if($validdate == TRUE) {
        $concatdate = $_POST['year']. "-" . sprintf("%02d", $_POST['day']) . "-" .
            sprintf("%02d", $_POST['month']). " " . $_POST['hour']. ":" . $_POST['minute']. ":00";
                
        $itemsql = "INSERT INTO items(id_user, id_cat, nombre, preciopartida, descripcion, fechafin)
                VALUES(". $_SESSION['USERID']. ", " . $_POST['cat']. ", '" . addslashes($_POST['name'])
                . "', " . $_POST['price']. ", '" . addslashes($_POST['description'])
                . "', '" . $concatdate . "');";
        mysqli_query($itemsql);
        $itemid = mysqli_insert_id(); //id del último item insertado
        header("Location: " . $config_basedir. "/addimages.php?id=" . $itemid);
        exit();
    }
    else {
        header("Location: " . $config_basedir ."/newitem.php?error=date");
        exit();
    }
}
else
    {
    
    require("header.php");
    
    if (isset($_GET['error'])){
        switch($_GET['error']) {
            case "date":
                echo "<strong>Fecha inválida - Elija otra!</strong>";
                break;
        }
    }
?>

    <h1>Añade nuevo item</h1>
    <strong>Paso 1</strong> - Añade detalles del item.
    <p>


    </p>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
        <?php
            $catsql = "SELECT * FROM categorias ORDER BY categoria;";
            $catresult = mysqli_query($catsql);
        ?>
        <tr>
            <td>Categoría</td>
            <td>
                <select name="cat">
                <?php
                    while($catrow = mysqli_fetch_assoc($catresult)) {
                        echo "<option value='". $catrow['id'] . "'>" . $catrow['categoria']. "</option>";
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Descripción</td>
            <td><textarea name="description" rows="10" cols="50"></textarea></td>
        </tr>
        <tr>
            <td>Fecha de fin para pujas</td>
            <td>
            <table>
                <tr>
                    <td>Día</td>
                    <td>Mes</td>
                    <td>Año</td>
                    <td>Hora</td>
                    <td>Minutos</td>
                </tr>
                <tr>
                    <td>
                        <select name="day">
                        <?php
                            for($i=1;$i<=31;$i++) {
                                echo "<option>" . $i . "</option>";
                            }
                        ?>
                        </select>
                    </td>
                    <td>
                        <select name="month">
                        <?php
                            for($i=1;$i<=12;$i++) {
                                echo "<option>" . $i . "</option>";
                            }
                        ?>
                        </select>
                    </td>
                    <td>
                        <select name="year">
                        <?php
                        for($i=date('Y'),$c=1;$c<=10;$i++,$c++) {
                            echo "<option>" . $i . "</option>";
                        }
                        ?>
                        </select>
                    </td>
                    <td>
                        <select name="hour">
                        <?php
                        for($i=0;$i<=23;$i++) {
                            echo "<option>" . sprintf("%02d",$i) . "</option>";
                        }
                        ?>
                        </select>
                    </td>
                    <td>
                        <select name="minute">
                        <?php
                            for($i=0;$i<=59;$i++) {
                                echo "<option>" . sprintf("%02d",$i) . "</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            </td>
        </tr>
        <tr>
            <td>Precio</td>
            <td><input type="text"name="price"><?php echo $config_currency; ?></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Enviar!"></td>
        </tr>
    </table>
    </form>   

<?php
    }
?>