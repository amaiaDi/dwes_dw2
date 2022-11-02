<?php require "cabecera.php";
    error_reporting (0);
    $email = $_GET['email'];
    $cadena = $_GET['cadena'];
    $sql = "select id from usuarios where email = '$email' and cadenaverificacion = '$cadena' and activo = '0'";
    $resultado = $conn->query($sql);
    if($conn->errno) die($conn->error);
    $fila = $resultado -> fetch_assoc();
    if ($fila['id']>0) {
        $id = $fila['id'];
        $sql = "update usuarios set activo = '1' where id = '$id'";
        $resultado = $conn->query($sql);
        if($conn->errno) die($conn->error);
        echo "<h2>Se ha verificado tu cuenta. Puedes entrar pinchando <a href='login.php'>log in</a></h2>";
    } else {
        echo "<h2>No se puede verificar dicha cuenta</h2>";
    }
    require "pie.php";
?>