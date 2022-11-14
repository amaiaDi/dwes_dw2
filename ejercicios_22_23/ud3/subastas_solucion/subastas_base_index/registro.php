<?php
    //Establece la información de la ultima pagina visitada.Cargamos la de la pagina a la que accedemos porque será la anteior al movernos a la siguiente
    //$_SESSION['pagina_anterior'] =  $_SERVER["REQUEST_URI"];

    //Si existe la variable registrarse en la variable POST de la petición del submit del formulario
    if(isset($_POST['registrarse'])){
        
        //comprobamos si existe el usuario en BD registrado, si existe volvemos a la pantalla con el mensaje
        $usuarioARegistrar=$_POST['usuario'];
        //Si el usuario existe, nos redirigimos a la pagina de registro mandando el mensaje de error 
        if(existeUsuario($usuarioARegistrar)){
            $mensaje = "El usuario $usuario ya existe";
            header("Location: index.php?ira=registro&mensaje=$mensaje");
        }
        //Si no existe, lo incluimos en BD obteniendo los datos enviados en la variable $_POST de la peticion del formulario
        else {
            
            $nombre = $_POST['nombre'];
            $pass = $_POST['password'];
            $email = $_POST['email'];
            $cadena_veri = crearCadenaVerificacion();
            
            // MANDAR MAIL PARA VERIFICACIÓN
            $url_cadena_veri=urlencode($cadena_veri); 
            $url_email = urlencode($email);
            $enlace=obtenerRutaFicheroHTTP()."/index.php?ira=verificacion&email=$url_email&cadena_verif=$url_cadena_veri";            
            
            $mens=<<<MAIL
            Hola $usuarioARegistrar. Haz clic en el siguiente enlace para registrarte:
            $enlace
            Gracias
            MAIL;
            
            if (mail($email,MAIL_TITULO, $mens, MAIL_FROM)){
                insertarUsuario($usuarioARegistrar, $nombre, $pass, $email, $cadena_veri);
                $mensaje = "El usuario ".strtoupper($usuarioARegistrar).MSJ_INFO_USUARIO_REGISTRADO;
                header("Location: index.php?ira=registro&mensaje=$mensaje");
            }
            else{
                echo "No se pudo enviar mensaje";
            }
            
        }
    }

    ?>
    <p><?=MSJ_INFO_PANTALLA_REGISTRO?></p>
    <form action="index.php?ira=registro" method="post">
        <table>
            <tr>
                <td><label for="usuario">Usuario</label></td>
                <td><input type="text" name="usuario"></td>
            </tr>
            <tr>
                <td><label for="nombre">Nombre completo</label></td>
                <td><input type="text" name="nombre"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td id="pass"><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><label for="password_2">Password (de nuevo)</label></td>
                <td><input type="password" name="password_2"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Registrarse" name="registrarse"></td>
            </tr>
        </table>
    </form>
    <p class="msg-rojo"><?php if(isset($_GET['mensaje'])) echo $_GET['mensaje'];?></p>

    
    <script>
        //Script de javascript para contolar la validación de las password al hacer click en el boton
        const btn = document.querySelector("input[type='submit']");
        btn.addEventListener("click", (event)=>{
            const pass = document.querySelector("input[name='password']");
            const pass_comp = document.querySelector("input[name='password_2']");
            if(pass.value !== pass_comp.value){
                event.preventDefault();
                const mensaje = document.createElement('p');
                mensaje.innerHTML = "* Las contraseñas no coinciden";
                const formulario = document.querySelector('form');
                formulario.appendChild(mensaje);
            } 
        });
    </script>