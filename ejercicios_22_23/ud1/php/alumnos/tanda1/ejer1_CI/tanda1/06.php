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
        function cif_cad ($cad){
            $cif = array("A"=>"20", "H"=>"9R", "M"=>"abcd");
            foreach ($cif as $carac => $valor){
                $cad = str_replace($carac, $valor, $cad); 
            }
            return $cad;
        }   
        echo cif_cad("HOLA AMO");
    ?>
</body>
</html>