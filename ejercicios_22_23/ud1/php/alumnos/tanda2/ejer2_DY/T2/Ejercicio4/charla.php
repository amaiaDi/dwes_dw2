<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
        $nom = $_GET['nom'];
        $texto = "";
        $arrayInsultos = array();

        if(isset($_POST['botonCharla'])){
            $texto = $_POST['cajaTexto'];

            //sustituir :)  :(
            $texto = sustituir(":)","🙂");
            $texto = sustituir(":(","🙁");

            //sustituir insultos por asteriscos
            cargarArrayInultos();
            for ($i = 0; $i < sizeof($arrayInsultos); $i++) {
                $asteriscos = "";
                for ($j=0; $j < strlen($arrayInsultos[$i]); $j++) { 
                    $asteriscos = $asteriscos."*";
                }
                $texto = sustituir($arrayInsultos[$i], $asteriscos);
            }

            //
            file_put_contents("charla.txt", $nom.": ".$texto."\n", FILE_APPEND);
        }

        function cargarArrayInultos(){
            global $arrayInsultos;
            $fp = fopen("insultos.txt", "r");
            while (!feof($fp)){
                $linea = fgets($fp);
                $linea = substr($linea, 0, stripos($linea,';'));
                array_push($arrayInsultos, $linea);
            }
            fclose($fp);
        }

        function sustituir($carViejo, $carNuevo){
            global $texto;
            if (strstr($texto, $carViejo)) {
                $texto = str_replace($carViejo, $carNuevo, $texto);
             }
            return $texto;
        }
    ?>
    <body>   
            <form  action="charla.php?nom=<?php echo $nom?>" method="post">
                <iframe src="contenido_charla.php"></iframe><br>
                Usuario: <?php echo $nom?><br>
                Mensaje: <input type="text" name="cajaTexto"><br>
                <input type="submit" value="Enviar" name="botonCharla"/>
            </form>
    </body>
</html>