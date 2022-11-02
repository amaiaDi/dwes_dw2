<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="8">  
    <title>Charla</title>
</head>
<body>
    <?php 
        $usuario="";
        
        if(isset($_GET["mensaje"])){
            $usuario = $_GET["mensaje"];            
        }  
    
        if(isset($_POST["charla"])){
            $usuario=$_POST["usu"];
            file_put_contents("ficheros/charla.txt","\r\n".$usuario.": ".$_POST['msg'], FILE_APPEND);  
        } 
    ?>


    <iframe src="contenido_charla.php"></iframe>
    

    <form action="charla.php?mensaje=<?php echo $usuario; ?>" method="post">
            
            <label>Nombre de usuario:<strong>
                <?php echo $usuario;?>
            </strong><br>
            <input type="hidden" value="<?php echo $usuario;?>" name="usu"/>
            <label>Mensaje:<input type="text" id="msg" name="msg"><br></label>
            <input type="submit" value="charla" name="charla"/>
        </form>
</body>
</html>