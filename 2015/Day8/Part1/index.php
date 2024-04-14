<pre>
<?php

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

// var_dump(str_replace("\\\\", "\\", "\\\\\\\\"));
$total = 0;
foreach ($content as $string) {
    // echo $string . "\n";
    $codeLength = strlen($string);

    // echo $string . "\t";
    $string = substr($string, 1, -1);

    $string = str_replace('\\"', "z", $string);
    // echo $string . "\t";
    $string = str_replace("\\\\", "z", $string);
    // echo $string . "\t";
    // $string = preg_replace("/\\x[0-9a-f]{2}/", "z", $string);

    while (($pos = strpos($string, "\\x")) !== false) {
        $char1 = substr($string, $pos+2, 1);
        $char2 = substr($string, $pos+3, 1);

        if ((($char1 >= "0" && $char1 <= "9") || ($char1 >= "a" && $char1 <= "f")) && (($char2 >= "0" && $char2 <= "9") || ($char2 >= "a" && $char2 <= "f"))) {
            $string = substr_replace($string, '', $pos, 3);
        }
    }
    
    // echo $string . "\t";

    // echo "\n";

    $finaleLength = strlen($string);
    $total += $codeLength - $finaleLength;
}

echo $total;
?>
</pre>