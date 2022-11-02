<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $alumnos=array("Ibon","Ibai","Unai","Aritz");
        $alumnos[]="Aketza";
        $alumnos[]="Alejandro";
        
        echo "<h2>Recorrido array por indices</h2>";
        for ($i=0; $i<count($alumnos); $i++){
            echo "<p>Indice $i:" . $alumnos[$i] ."</p>";
         
        }
        
        echo "<h2>Recorrido array con foreach</h2>";
        foreach ($alumnos as $alumnombre){
             echo "<p>$alumnombre</p>";
        }
        
        $temps=array("L"=>30,"M"=>25, "X"=>29.5);
        $temps["J"]=30;
        $temps["V"]=18;
        
        echo "<h2>Recorrido array asociativo foreach</h2>";
     
        foreach ($temps as $dia => $temp){
           echo "<p>Dia $dia: $temp grados</p>";
        }
        
        $saludo="Buenos dias";
        $cont=1;
        for ($i=0; $i< strlen($saludo)    ;$i++) {
            $color="red";
            if ($cont%2==0)
                $color="blue";
            
            echo "<span style='color:$color'>";
            echo $saludo[$i];
            echo "</span>";
            
            $cont++;
        }
        
        if (in_array("Unai",$alumnos))
                echo "<p>Unai contenido</p>";
        else {
                echo "<p>Unai NO contenido</p>";
        }
        
        $nums=[50,60,70,80];
        print_r($nums);
        //sort($nums);
        //print_r($nums);        
       
        
        shuffle($nums);
        
        print_r($nums);
        
        
        ?>
    </body>
</html>
