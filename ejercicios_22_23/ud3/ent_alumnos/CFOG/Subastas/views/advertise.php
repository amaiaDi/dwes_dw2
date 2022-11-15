<?php
require_once "./header.php";
require_once "../DB/DB_item.php";

$list_almostExpiredItem=getCloseToExpirationItems();
for($i=0; $i < count($list_almostExpiredItem); $i++)
{
    $butAniadir="send_$i";
    if(isset($_POST[$butAniadir]))
    {
        if(!isset($_SESSION["list_advert"]))
            $_SESSION["list_advert"]=[];

        $advertiser=$_POST["advertiser_$i"];
        $_t=$_POST["_t_$i"];
        $item_id=$_POST["item_id_$i"];
        $pathToItemDetails=BASE_ROUTE."views/itemdetails.php?item_id=$item_id";
        $item_description=$_POST["item_description_$i"];

        $_SESSION["list_advert"][]=[$advertiser, $_t, $pathToItemDetails, $item_description];
    }
}

if(isset($_POST["send_adverts"]))
{
    $list_advert=$_SESSION["list_advert"];
    for($i=0; $i < count($list_advert); $i++)
    {
        $ad=$list_advert[$i];
        $ad_advertiser=$ad[0];
        $ad_type=$ad[1];
        $pathToItemDetails=$ad[2];
        $item_description=$ad[3];

        if($ad_type == 0)          
        {
            $mail_subject=  "Publicidad de ".FORUM_TITLE;

            $mail_content=  <<<MAIL
                                Hola, haznos publi de esto:
                                $pathToItemDetails
                                Gracias
                            MAIL;
        
            $mail_headers=  'From: phpalas4am@gmail.com' . "\r\n" .
                            'MIME-Version: 1.0' . "\r\n" .
                            'Content-type: text/html; charset=utf-8';

            mail($ad_advertiser, $mail_subject, $mail_content,  $mail_headers);
        }
        else                    
        {
            $f=fopen("../lib/advertisers.txt", "a");
            $line="\nWeb: $ad_advertiser Descripción del item: $item_description";

            fwrite($f, $line);
            fclose($f);
        }
    }

    $_SESSION["list_advert"]=[];
}

function drawForm_advertiseItems()
{
    global $list_almostExpiredItem;

    $txtHTML="<form enctype='multipart/form-data' action=".str_replace(" ", "%20", $_SERVER["PHP_SELF"])." method='post'>";
    $txtHTML.=
    '
    <h2>Subastas a punto de vencer</h2>
    <table>
        <tr>
            <td>ITEM</td>
            <td>VENCE EN</td>
            <td>ANUNCIANTE</td>
            <td colspan="2">TIPO</td>
        </tr>
    ';

    for($i=0; $i < count($list_almostExpiredItem); $i++)
    {
        $item=$list_almostExpiredItem[$i];
        $item_id=$item["id"];
        $item_description=$item["descripcion"];
        $item_name=$item["nombre"];
        $item_endDate=$item["fechafin"];

        $dateObject=new DateTime(); 
        $otherDateObject=new DateTime($item_endDate);
        $diff=$dateObject -> diff($otherDateObject); 
        
        $diff_days=$diff -> days;
        $diff_hours=$diff -> h;
        $hoursLeft=$diff_days*24 + $diff_hours;

        $txtHTML.="<tr>";
        $txtHTML.="<td>$item_name<input type='hidden' value='$item_id' name='item_id_$i'><input type='hidden' value='$item_description' name='item_description_$i'></td>";
        $txtHTML.="<td>$hoursLeft horas</td>";
        $txtHTML.="<td><input type='text' name='advertiser_$i'></td>";
        $txtHTML.="<td>";
        $txtHTML.="<input type='radio' value='0' name='_t_$i' checked>Email";
        $txtHTML.="<input type='radio' value='1' name='_t_$i'>Web";
        $txtHTML.="</td>";
        $txtHTML.="<td><input type='submit' name='send_$i' value='Añadir'></td>";
        $txtHTML.="</tr>";
    }  

    if(isset($_SESSION["list_advert"]))
        $txtHTML.="<tr><td colspan='5'><input style='width:100%' type='submit' name='send_adverts' value='ENVIAR ANUNCIOS'></td></tr>"; 
    
    $txtHTML.=
    '
        </table>
    </form>
    ';    
        
    echo $txtHTML;
}
?>
    <?php
    drawForm_advertiseItems();
    ?>
</body>
</html>