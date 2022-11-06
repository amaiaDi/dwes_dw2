<?php
    include_once("libsubastas.php");
    if(isset($_GET['email']) && isset($_GET['cadena_verif'])){
        $mail = $_GET['email'];
        $cadena_verif = $_GET['cadena_verif'];
        if(comprobarMail($mail, $cadena_verif)){
            $id = idUsuarioEmail($mail);
            darUsuarioAlta($id);
            echo "<p class='verificacion'>Se ha verificado tu cuenta. Puedes entrar pinchando
                <a href='login.php'>aquí</a>
            </p>";
        }
        else {
            echo "No se puede vefificar dicha cuenta";
        }
    }

?>