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
        $nombres=array("Vitoria","Zaragoza","Vitoria","Vitoria","Paris","Londres","Paris","Vitoria","Madrid","Madrid");
        function lista($array){
            $arraySinRepetidos=array("");
            $a=0;
            echo"<ol>";
            for ($i=0; $i <count($array) ; $i++) { 
                $esta=false;
                for ($i2=0; $i2 <count($arraySinRepetidos) ; $i2++) { 
                    if ($array[$i]==$arraySinRepetidos[$i2]) {
                        $esta=true;
                        break;
                    }
                }
                if ($esta==false) {
                    echo "<li>$array[$i]</li>";
                    $arraySinRepetidos[$a]=$array[$i];
                    $a++;
                }
            }
            echo"</ol>";
        }
        lista($nombres);
    ?>
</body>
</html>