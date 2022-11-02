<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_GET['error']))
            echo "<p>Login erroneo</p>";
            
        ?>
        
        <form action="checklogin.php" method="post">
           Login <input type="text" name="login" />
           Password <input type="text" name="pass" />
           <input type="radio" name="sexo" value="H"/>Hombre
           <input type="radio" name="sexo" value="M"/>Mujer
           
           <input type="submit" name="submitlogin" value="ENTRAR" />
         
        </form>
    </body>
</html>
