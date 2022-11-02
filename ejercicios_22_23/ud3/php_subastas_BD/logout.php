<?php

session_start();
unset ($_SESSION["USERNAME"]);
require("config.php");

header("Location: " . $config_basedir);


?>
