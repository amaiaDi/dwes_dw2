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
       
        if (isset($_POST['submit'])){
            
            //$_FILES con un par (clave-valor) por cada
            //file subido
            
            
            
            //$_FILES['foto']['tmp_name']:Archivo en el servidor: 
            //$_FILES['foto'['name']: Nombre del archivo en el cliente
            //$_FILES['foto']['size']: Tamaño en bytes
            //$_FILES['foto']['type']: Tipo MIME del archivo. P.e "image/gif"
            
            //is_uploaded_file: ver si se ha podido subir
            
            //move_uploaded_file: retener/copiar el archivo en el servidor
            
            
            if (is_uploaded_file($_FILES['foto']['tmp_name'])){
                $origen=$_FILES['foto']['tmp_name'];                
                $destino="img/".$_POST['nombre'].".jpg";
                
                if (file_exists($destino))
                    echo "<p>Ya hay una imagen con ese nombre</p>";
                else
                    move_uploaded_file($origen,$destino); 
                
                echo "<img src='$destino'  height='30'/>";
                echo $_FILES['foto']['size']. " bytes ";
            }
            else{
                echo "<p>Foto mal. Tamaño max es" 
                . $_POST['MAX_FILE_SIZE'] ."</p>";
            }
        }
        
        
        
        ?>
        
        
        <form method="post" 
              enctype="multipart/form-data"
              action="<?php  echo $_SERVER['PHP_SELF'] ?>" >
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <input type="text" name="nombre" />
            <input type="file" name="foto" />
            <input type="submit" name="submit" value="SUBIR" />
        </form>
    </body>
</html>
