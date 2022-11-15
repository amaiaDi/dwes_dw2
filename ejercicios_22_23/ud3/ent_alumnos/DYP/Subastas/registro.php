
    <?php
        
        $error = "";
        $confirmacion = "";

        if(isset($_POST['passwordRepetida'])){
            $password = $_POST['password'];
            $passwordRepetida = $_POST['passwordRepetida'];
            if($password != $passwordRepetida){
                $error = "Las contraseñas no coinciden";
            }
        }

        //comprobar que el usuario exista en la base de datos
        if(isset($_POST['botonRegistrar'])){
            $sql = "SELECT nombre
                    from usuarios";
            $result = mysqli_query($con, $sql);
            while($fila = mysqli_fetch_assoc($result)){   
                if($_POST['nomUsu'] == $fila['nombre']){
                    $error = "El usuario ya existe";
                }
            }   
            if($error == ""){
                usuarioNuevo();
            }
        }

        function usuarioNuevo(){
            //crear un String con 15 caracteres aleatorios
            $characters = "abcdefghijklmnopqrstuvwxyz";
            $charactersLength = strlen($characters);
            $strAle = "";
            for ($i = 0; $i < 15; $i++) {
                $strAle .= $characters[rand(0, $charactersLength - 1)];
            }
            //Insertar Tupla
            //ALTER TABLE ITEMS CHANGE id INT(11) AUTO_INCREMENT PRIMARY KEY;
            $nombre = $_POST['nomUsu'];
            $username = $_POST['nomUsuCompleto'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $cadenaverificacion = $strAle;
            $email = $_POST['email'];
            $cadenaverificacion = $_POST['nomUsu'];
            $activo = 0;
            $sql = "INSERT INTO usuarios (username, nombre, password, email, cadenaverificacion, activo, falso) 
                                  VALUES ('$username','$nombre','$password','$email','$cadenaverificacion',0,0)";  
            global $con;
            $resultado = mysqli_query($con, $sql); 
            //Enviar un correo
            
            //
            global $confirmacion;
            $confirmacion = "Se ha creado el usuario correctamente";
        }

    ?>
            <div>
                <h1>REGISTRO</h1>
                <p>Para registrarte en SUBASTAS DANI, rellena el siguiente formulario</p>
                <span style="color: red;"><?php echo $error;?></span><br>
                <span style="color: green;"><?php echo $confirmacion;?></span><br>
            <form  action="index.php?ir=registro" method="post">
                        <table>
                            <tr class="body">
                                <tr>
                                    <td>Usuario</td>
                                    <td><input type="text" name="nomUsu" required/></td>
                                </tr>
                                <tr>
                                    <td>Nombre Completo</td>
                                    <td><input type="text" name="nomUsuCompleto"/><br></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input type="password" name="password" required/><br></td>
                                </tr>
                                <tr>
                                    <td>Password (de nuevo)</td>
                                    <td><input type="password" name="passwordRepetida"/></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email"/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" value="Registrate" name="botonRegistrar"/></td>
                                </tr>
                            </tr>
                        </table>
            </form>
        </div>
</html>