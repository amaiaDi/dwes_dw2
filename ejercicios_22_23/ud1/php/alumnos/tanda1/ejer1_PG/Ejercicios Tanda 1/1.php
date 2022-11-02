<!DOCTYPE html>
<html>
<body>

<?php
//1

echo date("dS F Y, l")."<br>";	

//2

$d=date("j");
$m=date("m");
$cont=1;
while($cont<$m){
    if($cont=="2"){
        $d=$d+28;
    }

    if($cont=="1" || $cont=="3" || $cont=="5" || $cont=="7" || $cont=="8" || $cont=="10" || $cont=="12"){
        $d=$d+31;
    }

    if($cont=="4" || $cont=="6" || $cont=="9" || $cont=="11"){
        $d=$d+30;
    }
    $cont=$cont+1;
    
}

if(date("L")==0){
    echo "365"-$d."<br>";
}
else{
    echo "366"-$d."<br>";
}

//3

$palabra = array("Hoy ","es ","lunes");
for($i=0;$i<count($palabra);$i++){ 
    echo $palabra[$i];
}
echo "<br>";

//4

$cadena="hola mundo"; 
for($i=0;$i<strlen($cadena);$i++){ 
    if(substr($cadena,$i,1)=="h"){
        echo "gn";
    }
    else{
        echo $cadena[$i]; 
    }
} 
echo "<br>";
//5
function random($n,$limite1,$limite2) {

    for($i=0;$i<$n;$i++){
        $arr=array($i=>random_int($limite1,$limite2));
    }   
    return $arr;
}


echo count(random(1,2,3));

//6

function cript($frase) {
    $crip=array("A"=>"20", "H"=>"9R", "M"=>"abcd");

    for($i=0;$i<strlen($frase);$i++){ 
        $cripL;
        $letra=substr($frase,$i,1);
        if(array_key_exists($letra,$crip)){
            $cripL=$crip[$letra];
            echo $cripL;
        }
        else {
            echo $letra;
        }
    }

}

cript("HAMZZ");
?>

</body>
</html>