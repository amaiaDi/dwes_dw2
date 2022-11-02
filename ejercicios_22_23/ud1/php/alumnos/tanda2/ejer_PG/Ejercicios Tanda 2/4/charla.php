<!DOCTYPE html>
<?php
    session_start();
?>
<html>

<body>
    <?php
    if(isset($_POST["env"])=="b"){
        if($_POST["tex"]!=""){
        $anadir = fopen("archivos/charla.txt", "a");
        fwrite($anadir, $_SESSION["userN"].";".$_POST["tex"].PHP_EOL);
        $_POST["tex"]="";
        fclose($anadir);
    }
}
    ?>
    <iframe src="contenido_charla.php"></iframe>
    <form action='charla.php' method='post'>
        <?php print $_SESSION["userN"]." : "?>
        <input type='text' id='tex' name='tex'>
        <button type="submit" name="env" value="b" id="env">Enviar</button>
    </form>
</body>
</html>