<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Índice</title>
</head>
<body>
    <h1>Índice</h1>
    <ul>
        <?php
            $n=1;
            $directories=scandir('./');
            foreach($directories as $dir){
                if(is_dir($dir)){
                    $urlDir='./'.$dir;
                    $files=scandir($urlDir);
                    foreach($files as $f){
                        $urlFile=$urlDir.'/'.$f;
                        
                        if(is_file($urlFile) and $f!='index.php' and strpos($f,'.php')!=false)                
                            echo "<a href='".$urlFile."'><li>Ejercicio ".$n++."</li></a>";
                    }
                }
            }
        ?>
    </ul>
</body>
</html>