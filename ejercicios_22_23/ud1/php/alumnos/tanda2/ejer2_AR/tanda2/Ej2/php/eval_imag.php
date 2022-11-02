<?php
    function rutasImg (){
        $arrImg = [];
        $arrext=["jpg","png","tiff","jpeg","gif"];
                $files=scandir('../images/');
                foreach($files as $f){
                    $ext = pathinfo($f, PATHINFO_EXTENSION);
                    if(in_array($ext, $arrext))
                    {
                        array_push($arrImg, $f);
                    }
                    
                }
        return $arrImg;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion</title>
</head>
<body>
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <table>
            <?php
                if (isset($_POST['enviarValo'])){
                    if (isset($_POST['chkMeGusta']) && count($_POST['chkMeGusta']) > 0){
                        echo "<p>Gracias por tu envio</p>";
                        
                        $f = fopen("../files/imagenesGustadas.txt", "a");
                        $txt = gethostbyname(gethostname()).":\t";
                        foreach ($_POST['chkMeGusta'] as $img){
                            $txt .= $img."\t";
                        }
                        $txt .= "\n";
                        fwrite($f, $txt);

                        fclose($f);

                    }else{
                        echo "<p>Sentimos que no le haya gustado ninguna</p>";
                    }
                    echo "<a href='../selec_cantidad.php'><input type='button' value='VOLVER'></input></a>";

                }else{
                    $arrImg = rutasImg();
                    shuffle($arrImg);

                    for ($cont = 1; $cont<= $_POST['selCantidad']; $cont++){
                        $txtHtml = "<tr><td>";
                        $txtHtml .= "<img width = '200' height ='120'  src='../images/".$arrImg[$cont-1]."'/></td>";

                        $txtHtml .= "<td>
                                    <input type='checkbox' name='chkMeGusta[]' value='".$arrImg[$cont-1]."'>
                                    <label for='chkMeGusta'>Me gusta</label>
                                </td>";
                        echo $txtHtml."</tr>";
                    }
                    echo "<tr><td><input type='submit' name='enviarValo' value='ENVIAR VALORACIONES'/></td></tr>";
                } 
            ?>
        </table>
    </form>
</body>
</html>