<?php
define("DATE_FORMATS", 
[
    "AM_PM"         => "A",
    "MILLISECONDS"  => "v",
    "SECONDS"       => "s",
    "MINUTES"       => "i",
    "HOUR_12"       => "h",
    "HOUR_24"       => "H",
    "DAY"           => "d",
    "DAY_TEXT"      => "l",
    "MONTH"         => "m",
    "MONTH_TEXT"    => "F",
    "YEAR"          => "Y"
]);

function format_date($input_date, $newFormat) 
{
    $output_date=new Datetime($input_date);
    return $output_date -> format($newFormat);
}

function format_money($inputMoney) 
{
    $inputMoney=str_replace(",", ".", $inputMoney);
    $exp_money=explode(".", "".$inputMoney);
    
    $money_integerPart=$exp_money[0];
    $money_decimalPart="00";

    if(count($exp_money) > 1)
    {
        $money_decimalPart=$exp_money[1];
        if(strlen($money_decimalPart) == 1)
            $money_decimalPart.="0";
    }  
    return $money_integerPart.".".$money_decimalPart.CURRENCY;
}
?>