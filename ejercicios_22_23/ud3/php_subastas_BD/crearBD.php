<?php
include("config.php");

if (!($conex=mysqli_connect($dbhost,$dbuser,$dbpassword)))
        die(mysqli_errno ());

$sql="drop database ". $dbdatabase ;

if (!mysqli_query($sql,$conex)){
    echo "No se puede borrar base de datos";
    //die();
}

$sql="create database ". $dbdatabase ;

if (!mysqli_query($sql,$conex)){
    echo "No se puede crear base de datos";
    die();
}
        
if (!mysqli_select_db($dbdatabase, $conex)){
     echo "No se puede conectar a base de datos " . $dbdatabase;
     die();
}
// TABLA CATEGORIAS
$sql=<<<EOT
    CREATE TABLE categorias        (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            categoria VARCHAR(30) NOT NULL
        )   
EOT;

if (!mysqli_query($sql,$conex)){
    echo "No se puede crear tabla categorias";
    die();
}

// TABLA USUARIOS
$sql=<<<EOT
    CREATE TABLE usuarios        (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(40),
            password  VARCHAR(40),
            email VARCHAR(100),
            cadenaverificacion VARCHAR(100),
            activo TINYINT
            
        )   
EOT;

if (!mysqli_query($sql,$conex)){
    echo "No se puede crear tabla usuarios";
    die();
}
 

// TABLA ITEMS
$sql=<<<EOT
    CREATE TABLE items        (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id_cat INT,
            id_user INT,
            nombre VARCHAR(50),
            preciopartida FLOAT,
            descripcion VARCHAR(200),
            fechafin DATETIME,
            FOREIGN KEY (id_cat) REFERENCES categorias(id) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (id_user) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
     )   
EOT;

if (!mysqli_query($sql,$conex)){
    echo "No se puede crear tabla items";
    die();
}

// TABLA PUJAS
$sql=<<<EOT
    CREATE TABLE pujas        (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id_item INT,
            id_user INT,
            cantidad FLOAT,
            FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (id_user) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
     )   
EOT;

if (!mysqli_query($sql,$conex)){
    echo "No se puede crear tabla pujas";
    die();
}

// TABLA IMAGENES
$sql=<<<EOT
    CREATE TABLE imagenes        (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            id_item INT,
            imagen VARCHAR(100),
            FOREIGN KEY (id_item) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE
     )   
EOT;

if (!mysqli_query($sql,$conex)){
    echo "No se puede crear tabla imagenes";
    die();
}


echo "BASE DE DATOS CORRECTAMENTE CREADA"





?>
