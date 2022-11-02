<?php
    session_start();

    // Incluimos los ficheros de funciones y constantes generales
    include_once("../funciones.php");
    include_once("../constantes.php");

    $error="";
    $nombre="";
    $arrayNombresSession;

    //Comprobamos si el array de sesion nombres existe y si no existe se inicializa
    if( !isset($_SESSION['nombres'])  ||(isset($_SESSION['nombres']) && empty($_SESSION['nombres']))){
        $_SESSION['nombres']= array();
        $arrayNombresSession= array();
    }else{
        $arrayNombresSession=$_SESSION['nombres'];
    }

    //Si se ha pulsado el boton Añadir
    //Comprobamos si el dato nombre ha venido cargado y si es correcto. si es correcto lo añadimos a la pantalla de nuevo y lo guardamos en sesion
    //tambien comprobamos previamente si existe la variable de sesion que es un arry para guardar nombres
    if(isset($_POST['btnAniadir']) && isset($_POST['textoNombre'])){

        //Si el campo viene vacio se muestra mensaje de error
        if(empty($_POST['textoNombre'])){
            $error= CAMPO_VACIO;
        }else{
            //Si no ha venido vacio, se comprueba que los caracteres sean correctos. Si son, se recupera nombre y se mete en el array de session, si no existe previamente
            if(fncEsTextoValido($_POST['textoNombre'])){
                $nombre=$_POST['textoNombre'];

                //Comprobamos si el nombre ya existe en el array. Si existe mostramos error
                if(in_array($nombre, $arrayNombresSession)){
                    $error=NOMBRE_REPETIDO;
                //Si no, incluimos el nombre en el array de nombres de session y lo asignamos a la variable de sesion
                }else{
                    array_push($arrayNombresSession, $nombre);
                    $_SESSION['nombres']=$arrayNombresSession;
                }
            //Si el formato no es el adecuado se muestra mensaje
            }else{
                $error= NOMBRE_FORMATO ;
            }
        }

    }

    //Si se ha pulsado el boton Borrar
    //Eliminamos la variable de session y recargamos la pantalla
    if(isset($_POST['btnBorrar']) ){
        unset($_SESSION['nombres']);
        $arrayNombresSession=array();
    }

    //Si hemos pulsado el enlace y existe la variable cerrar_session y ademas es true, destruimos la session
    if(isset($_GET['cerrar_sesion']) && !empty($_GET['cerrar_sesion']) && $_GET['cerrar_sesion']==true){
        session_destroy();
        header('Location: ejercicio1.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilos.css"></link>
    <title>Ejericio 1 - Añadir usuario a listado- Sesiones</title>

</head>
<body>
    <div id="fondo_azul">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table>
                <tr>
                    <p class="error"> <?php echo $error ?></p>
                </tr>
                <tr>
                    <td>Escribir algún nombre</td>
                    <td><input type="text" name="textoNombre" value="<?php echo $nombre;?>"></input></td>
                </tr>
                <tr>
                    <td colspan=2> 
                        <p class="botones">
                            <input type="submit" name="btnAniadir" value="Añadir"></input>
                            <input type="submit" name="btnBorrar" value="Borrar"></input>
                        </p>   
                    </td>
                </tr>
                <tr>
                    <td colspan=2> 
                        <?php
                            $cuantos=count($arrayNombresSession);
                            echo "<ul>";
                                for($i=0;$i<$cuantos;$i++){
                                    echo "<li>".$arrayNombresSession[$i]."</li>";
                                }
                            echo "</ul>";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=2> 
                        <a href="ejercicio1.php?cerrar_sesion=true"> Cerrar Sesion (Se perderan todos los datos almacenados)</a>
                    </td>
                </tr>
            </table>
        </form>
       
    <div>
</body>
</html>