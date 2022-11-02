<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

       
            $nombre = "cars2";
        function pelis($nombre){
            $peli = array(
                "adrian"=>array("cars2","spiderman","grinch"), 
                "dani"=>array("trasnformers1","trasnformers2","trasnformers3"), 
                "vitores"=>array("shrek1","shrek2","shrek3"), 
                "perez"=>array("cars1","cars2","grinch"));
            
            $n = 0;
            
            foreach ($peli as $key ) {
                if($key[0]==$nombre){
                        $n++;
                }
                if($key[1]==$nombre){
                    $n++;
                }
                if($key[2]==$nombre){
                    $n++;
                }

                
            }
            echo($n);
        }
        pelis("cars2");

        //sacar dos pelis
        echo("<br>");
        echo("<br>");
        function pelisAleatorias(){
            $peli = array(
                "adrian"=>array("cars2","spiderman","grinch"), 
                "dani"=>array("trasnformers1","trasnformers2","trasnformers3"), 
                "vitores"=>array("shrek1","shrek2","shrek3"), 
                "perez"=>array("cars1","cars2","grinch"));
            
            
            $num1=0;
            $num2=0;
                foreach ($peli as $key ) {
                    $num1=mt_rand(0,2);
                    $num2=mt_rand(0,2);
                    while ($num1==$num2) {
                        $num2=mt_rand(0,2);
                    }
                    echo("<br>");
                    echo($key[$num1]);
                    echo("  ");
                    echo($key[$num2]);
                    echo("<br>");
                    

                }
            
        }
        pelisAleatorias();
    ?>
</body>
</html>
