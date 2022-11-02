<!DOCTYPE html>
<head>
    <meta http-equiv="refresh" content="2">  
    <script type="text/javascript">
        window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
    }
</script>

</head>
<html>
<body>

<?php
$handle = fopen("archivos/charla.txt", "r");
while(!feof($handle)){
    $linea = fgets($handle);
    $nom = strchr($linea,";",1);
    $mesg = substr(strchr($linea,";"),1);
    if($mesg!=""){
    print "$nom : $mesg<br>";
    }
}
fclose($handle);



    
    
?>

</body>
</html>