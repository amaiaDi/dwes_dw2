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
        $temperaturasMes=array("21","14","15","19","24","12","1","12","32");
        $media = array_sum($temperaturasMes)/count($temperaturasMes);
        $redondeada=round($media);
        function truncar($numero, $digitos){
            $truncar = 10**$digitos;
            return intval($numero * $truncar) / $truncar;
        }
        $truncado=truncar($media, 0);

        function masGrandes($array){
            $a=0;
            $arrayCon5=array(0,0,0,0,0);
            $masG="";
            while ($a < 5) {
                for ($i=0; $i < count($array); $i++) { 
                    if ($arrayCon5[$a]<$array[$i]) {
                        $contA=count($arrayCon5);
                        $esta=false;
                        for ($i2=0; $i2 <$contA ; $i2++) { 
                            if ($array[$i]==$arrayCon5[$i2]) {
                                $esta=true;
                                break;
                            }
                        }
                        if ($esta==false) {
                            $arrayCon5[$a]=$array[$i];
                        }
                    }
                }
                $masG="$arrayCon5[$a], $masG";
                $a++;
            }
            return $masG;
        }

        function masPequenas($array){
            $a=0;
            $arrayCon5=array(99,99,99,99,99);
            $masG="";
            while ($a < 5) {
                for ($i=0; $i < count($array); $i++) { 
                    if ($arrayCon5[$a]>$array[$i]) {
                        $contA=count($arrayCon5);
                        $esta=false;
                        for ($i2=0; $i2 <$contA ; $i2++) { 
                            if ($array[$i]==$arrayCon5[$i2]) {
                                $esta=true;
                                break;
                            }
                        }
                        if ($esta==false) {
                            $arrayCon5[$a]=$array[$i];
                        }
                    }
                }
                $masG="$arrayCon5[$a], $masG";
                $a++;
            }
            return $masG;
        }

        $masAltas=masGrandes($temperaturasMes);
        $masBajas=masPequenas($temperaturasMes);
        echo "
            <p>$redondeada</p>
            <p>$truncado</p>
            <p>$masAltas</p>    
            <p>$masBajas</p>
        ";
    ?>
</body>
</html>