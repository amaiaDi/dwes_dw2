<?php
session_start();
require("config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword);
mysqli_select_db($dbdatabase, $db);
if($_POST['submit']) {
    $sql = "SELECT * FROM usuarios WHERE username = '"
        . $_POST['username'] . "' AND password = '". $_POST['password'] . "';";
    $result = mysqli_query($sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1) {
        $row = mysqli_fetch_assoc($result);
        if($row['activo'] == 1) {
       //USUARIO-PASS OK y CUENTA ACTIVADA
            $_SESSION['USERNAME'] = $row['username'];
            $_SESSION['USERID'] = $row['id'];
            switch($_SESSION['REF']) {
                  case "addbid":
                    header("Location: " . $config_basedir . "/itemdetails.php?id=" . $_GET['id'] );
                    exit;  
                    break;
                case "newitem":
                    header("Location: " . $config_basedir . "/newitem.php");
                    exit;
                    break;
                case "images":
                    header("Location: " . $config_basedir  . "/addimages.php?id=" . $_GET['id']);
                    exit;
                    break;
                default:
                    header("Location: " . $config_basedir);
                    exit;
                    break;
            }
        }
        else {
        //USUARIO-PASS OK, PERO CUENTA NO ACTIVADA
            require("header.php");
            echo "Esta cuenta no esta verificada. Te hemos enviado un email para
                que la actives. Haz click en el link del email.";
        }
    }
    else {
        header("Location: " . $config_basedir . "/login.php?error=1");
    }
}
else {
    //NO VENIMOS DEL FORMULARIO
    require("header.php");
    echo "<h1>Login</h1>";
}

if(isset($_GET['error'])) {
    echo "Login incorrecto. Inténtalo de nuevo!";
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table>
    <tr>
        <td>Usuario</td>
        <td><input type="text" name="username"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Login!"></td>
    </tr>
</table>
</form>
No tienes una cuenta? <a href="register.php">Regístrate</a>!
