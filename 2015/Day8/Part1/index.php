<pre>
<?php

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

// var_dump(str_replace("\\\\", "\\", "\\\\\\\\"));
$total = 0;
foreach ($content as $string) {
    // echo $string . "\n";
    $codeLength = strlen($string);

    str_replace("\\\\", "\\", $string);
    preg_replace("/\\x[0-9a-f]{2}/", "z", $string);
    str_replace("\\\\", "zz", $string);

    $finaleLength = strlen($string) - 2;
    $total += $codeLength - $finaleLength;
}

echo $total;
?>
</pre>