<!DOCTYPE html>
<?php
    session_start();
?>
<html>
    <style>
        .pf{
            background-color:gray;
            text-align:center;
        }
    </style>
<body>

<?php
$f=0;
if(isset($_POST["reg"])=="b"){
    $handle = fopen("archivos/usuarios.txt", "r");
    while(!feof($handle)){
        $linea = fgets($handle);
        $nom = strchr($linea,";",1);
        if($_POST["nombre"]==$nom){
            print 'ERROR USUARIO REGISTRADO: '.$_POST["nombre"];
            $f=1;
        } 
    }
    fclose($handle);
    if($f!=1){
    $anadir = fopen("archivos/usuarios.txt", "a");
    fgets($anadir);
    fwrite($anadir, $_POST["nombre"].";".$_POST["contrasena"].PHP_EOL);
    $_SESSION["userN"]=$_POST["nombre"];
    $_SESSION["nombre"]=$_POST["nombre"];
    $_POST["nombre"]="";
    $_POST["contrasena"]="";
    fclose($anadir);
    
    header("Location: login.php?ok=1");
    }
}


?>
    <form action='alta.php' method='post'>
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input type='text' id='nombre' name='nombre'></td>
                <td colspan="2"><button type="submit" name="reg" value="b" id="reg">Registrar</button></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type='text' id='contrasena' name='contrasena'></td>
                
            </tr>
        </table>
    </form>
</body>
</html>