<?php


    require("header.php");
    $verifystring = urldecode($_GET['verify']);
    $verifyemail = urldecode($_GET['email']);

    
    $sql = "SELECT id FROM usuarios WHERE cadenaverificacion= '". $verifystring 
            . "' AND email = '" . $verifyemail . "';";
//    echo $sql;
    $result = mysqli_query($sql);
    $numrows = mysqli_num_rows($result);

    if($numrows == 1) {
        $row = mysqli_fetch_assoc($result);
        $sql = "UPDATE usuarios SET activo = 1 WHERE id = " . $row['id'];
        $result = mysqli_query($sql);
        echo "Se ha verificado tu cuenta. Puedes entrar pinchando
            <a href='login.php'>log in</a>";
    }
    else {
        echo "No se puede verificar dicha cuenta";
    }


?>
