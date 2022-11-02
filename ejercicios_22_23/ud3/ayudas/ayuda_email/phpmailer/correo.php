
        <?php        
        require("class.phpmailer.php"); 
        
        if (isset($_GET['usuario'])){
            echo "Has sido registrado ". $_GET['usuario'];
            echo urldecode($_GET['cadver']);
        }               
       
        if (isset($_GET['correo'])){    
           
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Timeout  =   30;
                $mail->SMTPAuth = true; 
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->SMTPSecure = 'tls';                 
                $mail->Username = "amaia.di@icjardin.com";                 
                $mail->Password = "Icjardin_2022";                
                $mail->From = "amaia.di@icjardin.com";
                $mail->FromName = "app web";              
                $mail->AddAddress("amaia.di@icjardin.com","Amaia");
                $mail->Subject = "Probando envio";

                
                //$body = "Hola, este es un…";         
                // $mail->Body = $body;
                 $mail->IsHTML(true);              
                 
                $randomstring="";
                for($i = 0; $i < 16; $i++) {
                    $randomstring .= chr(mt_rand(32,126));
                }
                $cadver=urlencode($randomstring);
                
 $enlace="http://localhost/Prueba/correo.php?usuario=nerea&cadver=$cadver";              
                 $body="<a href='$enlace'>Pincha para activar</a>";

                 $mail->msgHTML($body);  
                if(!$mail->Send()){
                    echo "No se pudo enviar el Mensaje.";
                }else{
                     echo "Mensaje enviado";
                }
        }       
        
        echo "<p><a href='correo.php?correo'>Enviar correo</a></p>";
        ?>