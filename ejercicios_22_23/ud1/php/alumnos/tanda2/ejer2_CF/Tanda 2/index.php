<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD1 T2</title>
</head>
<body>
    <header>
        <h1>UD1 T2 Ejercicios</h1>
    </header>
    <ul>
		<?php
            $n=1;
            $directories=scandir('./');
            foreach($directories as $dir)
            {
                if(is_dir($dir))
                {
                    $urlDir='./'.$dir;
                    $files=scandir($urlDir);
                    foreach($files as $f)
                    {
						$urlFile=$urlDir.'/'.$f;
                        if(is_file($urlFile) and $f!='index.php' and strpos($f,'.php')!=false)  
                            echo "<li><a href='".$urlFile."'>Ejercicio ".$n++."</a></li>";
                    } 
                }
            }
        ?>
    </ul>
</body>
</html>