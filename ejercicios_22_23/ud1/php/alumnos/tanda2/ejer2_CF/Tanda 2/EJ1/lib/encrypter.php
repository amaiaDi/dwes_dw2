<?php
function encrypt_cesar($input, $displacement)
{
    $output="";
    $diff=ord('Z')-ord('A')+1;
    for($i=0; $i<strlen($input); $i++)
    {
        $asciiLetter=ord($input[$i]);
        if($asciiLetter >= ord('A') && $asciiLetter <= ord('Z'))
        {
            $asciiLetter+=$displacement;
            if($asciiLetter < ord('A'))
                $asciiLetter+=$diff;
            else if($asciiLetter > ord('Z'))
                $asciiLetter-=$diff;
        }
        $output.=chr($asciiLetter);
    }
    return $output;
}

function encrypt_replacement($input, $f)
{
    $output="";
    $f_text="";

    $handle=fopen(DIR_REPLACEMENT.$f, "r");
    if(!feof($handle)) 
        $f_text=fgets($handle); 
    fclose($handle);

    for($i=0; $i<strlen($input); $i++)
    {
        $letter=$input[$i];
        if(ord($letter) < ord('A') || ord($letter) > ord('Z'))
            $output.=$letter;
        else
            $output.=$f_text[ord($letter)-ord('A')];
    }
    return $output;
}
?>