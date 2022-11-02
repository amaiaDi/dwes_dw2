<?php
    //CONECTARSE A LA BD
    include("config.php");
    if (!($conex=mysqli_connect($dbhost,$dbuser,$dbpassword)))
        die(mysqli_errno ());
    if (!mysqli_select_db($dbdatabase, $conex)){
            echo "No se puede conectar a base de datos " . $dbdatabase;
            die();
    }
    
   //INSERTAR CATEGORIAS
    $sql=<<<EOT
        
    insert into categorias (categoria) values
    ("joyas"),
    ("libros")
   
EOT;
    
    if (!mysqli_query($sql,$conex)){
            echo "No se pueden insertar tuplas en categorias";
            die();
    }
    
      //INSERTAR USUARIOS
    $sql=<<<EOT
        
    insert into usuarios (username, password, email, cadenaverificacion, activo) values
    ("admin","123456","nereags@hotmail.com","",1),
    ("Juan","123456","nereags@hotmail.com","",1),
    ("Pepe","123456","nereags@hotmail.com","",1)
EOT;
    
    if (!mysqli_query($sql,$conex)){
            echo "No se pueden insertar tuplas en usuarios";
            die();
    }
    
      //INSERTAR ITEMS
    $sql=<<<EOT
        
    insert into items (id_cat,id_user,nombre, preciopartida, descripcion,fechafin) values
    (1,1,"Anillo de Marilyn",20000,"Anillo original de boda de Marilyn Monroe que uso....","2012-12-22 13:00:00"),
    (1,2,"Collar de Maria Antonieta",320000,"Collar original de la reina Maria Antonieta","2012-12-24 18:30:00"),
    (2,1,"David Copperfield",10000,"Primera edición de la novela de Dickens","2013-02-01 20:20:00")
   
EOT;
    
    if (!mysqli_query($sql,$conex)){
            echo "No se pueden insertar tuplas en usuarios";
            die();
    }

    
     //INSERTAR PUJAS
    $sql=<<<EOT
        
    insert into pujas (id_item,id_user,cantidad) values
    (1,2,22000),
    (1,3,23000),
    (2,1,350000)
       
EOT;
    
    if (!mysqli_query($sql,$conex)){
            echo "No se pueden insertar tuplas en pujas";
            die();
    }

    
     //INSERTAR IMAGENES
    $sql=<<<EOT
        
    insert into imagenes (id_item,imagen) values
    (1,"anillo.jpg"),
    (1,"anillo2.jpg"),
    (2,"collar1.jpeg"),
    (2,"collar2.jpg"),
    (2,"collar3.jpg"),
    (3,"david1.jpg")
       
EOT;
    
    if (!mysqli_query($sql,$conex)){
            echo "No se pueden insertar tuplas en imagenes";
            die();
    }
    

    
    echo "Datos insertados";
?>


