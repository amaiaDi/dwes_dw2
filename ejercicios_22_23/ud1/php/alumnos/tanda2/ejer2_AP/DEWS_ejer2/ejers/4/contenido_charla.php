<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2">
    <script type="text/javascript">
        function setScroll() {
            window.scrollTo(0, document.body.scrollHeight);
            console.log("asd");
        }

        setInterval(setScroll, 100);
    </script>
    <title>Document</title>
</head>
<body>
    <?php
        $chat = fopen("charla.txt", "r");
        
        while (!feof($chat)) {
            $lineaChat = fgets($chat);
            $banWords = fopen("palabras_prohibidas.txt", "r");
            $autor = substr($lineaChat,0,strpos($lineaChat,':')+1);
            $msg = substr($lineaChat,strpos($lineaChat,':')+1);
            while (!feof($banWords)) {
                $malaPal = trim(fgets($banWords));
                $msg = str_replace($malaPal, "****", strtolower($msg));
            }
            $msg = str_replace(":)", "🙂", $msg);
            $msg = str_replace(":(", "🙁", $msg);
            echo $autor . $msg . "<br>";
        }
        fclose($chat);
    ?>
</body>
</html>