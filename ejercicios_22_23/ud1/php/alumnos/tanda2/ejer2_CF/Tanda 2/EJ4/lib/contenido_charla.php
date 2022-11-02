<?php
define("CHAT_CONTENT", "../files/chat-content.txt");
define("OFFENSIVE_WORDS", "../files/offensive-words.txt");
define("TEXT_REPLACE", getTextToReplace());

function drawChat()
{
    if(file_exists(CHAT_CONTENT))
    {
        $f=fopen(CHAT_CONTENT, "r");
        while(!feof($f)) 
        {
            $line=fgets($f); 
            $exp_line=explode(";EJ4;", $line);
            if(count($exp_line)==2)
            {
                $userName=$exp_line[0];
                $message=trim($exp_line[1]);
                $message=str_ireplace(TEXT_REPLACE[0], TEXT_REPLACE[1], $message);
                echo "<p><strong>${userName}: </strong>$message</p>";
            }
        }
        fclose($f);
    }
}

function getTextToReplace()
{
    $text_replace=[];
    $list_text=[];
    $list_replace=[];
    if(file_exists(OFFENSIVE_WORDS))
    {
        $f=fopen(OFFENSIVE_WORDS, "r");
        while(!feof($f)) 
        {
            $line=trim(fgets($f)); 

            $lineReplace="";
            for($i=0; $i<strlen($line); $i++)
                $lineReplace.="*";

            $list_text[]=$line;
            $list_replace[]=$lineReplace;
        }
        fclose($f);
    }

    $list_text[]=":)";
    $list_replace[]="<img style='width: 20px;' src='../images/happy-face.png' alt='Emoji Feliz'>";
    $list_text[]=":(";
    $list_replace[]="<img style='width: 20px;' src='../images/sad-face.png' alt='Emoji Triste'>";

    $text_replace[0]=$list_text;
    $text_replace[1]=$list_replace;
    return $text_replace;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2">     
    <title>Chat iframe</title>
</head>
<body>
    <?php
    drawChat();
    ?>
</body>
<script type="text/javascript">
window.onload
{
    window.scrollTo(0, document.body.scrollHeight);
}
</script>
</html>