<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi primer acercamiento a CI</title>
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <ul>
        <?php foreach($lista as $elemento){ ?>
            <li><?php echo $elemento; ?></li>
        <?php } ?>
    </ul>
</body>
</html>