<?php 
require_once "./header.php";
require_once "../DB/DB_user.php";
?>
    <?php
    if(isset($_GET["user_email"]) && isset($_GET["user_verificationCode"]))
    {
        $user_verificationCode=urldecode($_GET["user_verificationCode"]);
        $user_email=urldecode($_GET["user_email"]);

        if(verifyUser($user_verificationCode, $user_email))
            echo "<p>Se ha verificado tu cuenta. Puedes entrar pinchando <a href='login.php'>log in</a></p>";
        else
            echo "<p>No se puede verificar dicha cuenta.</p>";
    }
    ?>
</body>
</html>