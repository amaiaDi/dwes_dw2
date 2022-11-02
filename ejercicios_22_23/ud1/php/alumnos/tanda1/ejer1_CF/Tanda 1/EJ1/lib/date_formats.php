<?php
date_default_timezone_set('Europe/Madrid'); 
define("DATE_FORMATS", 
[
    "AM_PM" => "A",
    "MILLISECONDS" => "v",
    "SECONDS" => "s",
    "MINUTES" => "i",
    "HOUR_12" => "h",
    "HOUR_24" => "H",
    "DAY" => "d",
    "DAY_TEXT" => "l",
    "MONTH" => "m",
    "MONTH_TEXT" => "F",
    "YEAR" => "Y"
]);

function getFormatedDate($datestr, $format) 
{
    $date=new Datetime($datestr);
    return $date->format($format);
}
?>