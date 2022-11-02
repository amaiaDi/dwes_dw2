<!DOCTYPE html>
<html>
<body>

<?php
$imagenes=array("https://www.tooltyp.com/wp-content/uploads/2014/10/1900x920-8-beneficios-de-usar-imagenes-en-nuestros-sitios-web.jpg"
,"https://www.rdstation.com/blog/wp-content/uploads/sites/2/2017/09/thestocks.jpg",
"https://d7lju56vlbdri.cloudfront.net/var/ezwebin_site/storage/images/_aliases/img_1col/noticias/solar-orbiter-toma-imagenes-del-sol-como-nunca-antes/9437612-1-esl-MX/Solar-Orbiter-toma-imagenes-del-Sol-como-nunca-antes.jpg",
"https://cnnespanol.cnn.com/wp-content/uploads/2022/07/220713165438-rba-web-nasa-full-169.jpg?quality=100&strip=info&w=384&h=216&crop=1",
"https://images.pexels.com/photos/209807/pexels-photo-209807.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500",
"https://educacion30.b-cdn.net/wp-content/uploads/2019/02/girasoles-978x652.jpg",
"https://i.blogs.es/ceda9c/dalle/450_1000.jpg",
"https://educacion30.b-cdn.net/wp-content/uploads/2019/02/girasoles-978x652.jpg",
"https://ep01.epimg.net/elpais/imagenes/2019/10/30/album/1572424649_614672_1572453030_noticia_normal.jpg"

);
$cont=1;
$imagenes=array_unique($imagenes);
print "<table>";
foreach($imagenes as $cod => $img){
    

    if($cont==1){
        echo "<tr>";
    }
 
    print "<td><img src=$img width='500' height='500'</td>";
   
    if($cont==3){
        print "</tr>";
        $cont=0;
    }

    $cont++;
 
}
print "</table>";

?>
</body>
</html>