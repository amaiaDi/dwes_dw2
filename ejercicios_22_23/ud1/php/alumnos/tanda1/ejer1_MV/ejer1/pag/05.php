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
        
        $arrayNomPel = array(
                array("Lucas", "peli1","peli2","peli3","peli7"),
                array("Aitor", "peli3","peli4","peli8"),
                array("David", "peli2","peli5","peli9","peli3")
            );

        function peliFavoriata($nomPel,$arrayNomPel){
            $cont=0;
            for ($i=0; $i < sizeof($arrayNomPel); $i++) { 
                for ($i2=0; $i2 <sizeof($arrayNomPel[$i]) ; $i2++) { 
                    if ($arrayNomPel[$i][$i2]==$nomPel) {
                        $cont++;
                    }
                }
            }
            return $cont;
        }
        $numPer=peliFavoriata("peli2",$arrayNomPel);

        echo"
            <p>${numPer}</p>
        ";

        function peliFavoriataAl($arrayNomPel){
            for ($i=0; $i < sizeof($arrayNomPel); $i++) { 
                $numAlazar2=-1;
                $nombre=$arrayNomPel[$i][0];
                echo"<p>${nombre}: ";
                for ($i2=0; $i2 <2 ; $i2++) { 
                    $totalPelis=count($arrayNomPel[$i]);
                    do {
                        $numAlazar=random_int(1,$totalPelis-1);
                    } while ($numAlazar==$numAlazar2);
                    $numAlazar2=$numAlazar;
                    $peli=$arrayNomPel[$i][$numAlazar];
                    echo"${peli}, ";
                }
                echo"</p>";
            }
        }

        peliFavoriataAl($arrayNomPel);

    ?>
</body>
</html>