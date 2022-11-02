<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2">  
    <title>Ejercicio 4</title>
</head>
<body>
    <?php 
        mostrarCharla();
        if(isset($_POST["charla"]) && !empty($_POST["mensaje"])){
            session_start();
            aniadirCharla($_SESSION["usuario"].": ".$_POST["mensaje"]);
            header("Location: charla.php");
        }
    ?>
</body>
    <?php 
        function mostrarCharla(){
            $archivo = fopen("../ficheros_ejercicio2_5/charla.txt","r");
            while (!feof($archivo)) {
                $linea = fgets($archivo);
                $usuario = substr($linea,0,strpos($linea,":"));
                $texto = substr($linea,strpos($linea,":"));
                $texto = str_replace(":(","<img src='../emoticonos/triste.jpg' alt='triste.jpg' width='15px' height='15px'/>",$texto);
                $texto = str_replace(":)","<img src='../emoticonos/feliz.png' alt='feliz.png' width='15px' height='15px'/>",$texto);
                echo "<p><b>".$usuario."</b>".$texto."</p>";
            }
            fclose($archivo);
        }
        function aniadirCharla($charla){
            $archivo = fopen("../ficheros_ejercicio2_5/charla.txt","a");
            fwrite($archivo,"\n".$charla);
            fclose($archivo);
        }
    ?>
    <script type="text/javascript">
        window.onload = function() {
                window.scrollTo(0, document.body.scrollHeight);
        }
    </script>
</html>