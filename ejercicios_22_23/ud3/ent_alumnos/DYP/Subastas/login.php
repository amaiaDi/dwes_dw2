 <?php
        $error = "";

        if(isset($_POST['botonLogin'])){
            $nombre = $_POST['nomUsu'];
            $password = $_POST['password'];
            //validar que el usuario y la contraseña sean correctas
            $sql = "SELECT nombre, password, activo, id
                    from usuarios
                    where nombre = '$nombre'
                    and password = '$password'";
            $result = mysqli_query($con, $sql);
            $fila = mysqli_fetch_assoc($result);
            if($fila == null){
                $error = "El usuario o la contraseña no son correctos";
            }else{
                if($fila['activo'] == 0){
                    $error = "El usuario no esta activo";
                }else{
                    $_SESSION['id'] = $fila['id'];
                    $_SESSION['usuario'] = $fila['nombre'];
                    header("location:index.php");
                }
            }
        }

    ?>
            <div>
                <h1>LOGIN</h1>
                <span style="color: red;"><?php echo $error;?></span><br>
            <form  action="index.php?ir=login" method="post">
                        <table>
                            <tr class="body">
                                <tr>
                                    <td>Usuario</td>
                                    <td><input type="text" name="nomUsu" required/></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><input type="password" name="password"/><br></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="submit" value="Login!" name="botonLogin"/></td>
                                </tr>
                            </tr>
                        </table>
            </form>
            No tienes una cuenta?
            <a href="registro.php">Registrate!</a>
            </div>
</html>