<pre>
<?php

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$total = 0;
foreach ($content as $string) {
    // echo $string . "\n";
    $length = strlen($string);

    $string = str_replace('\\', '\\\\', $string);
    $string = str_replace('"', '\\"', $string);

    $finaleLength = strlen($string) + 2;
    $total += $finaleLength - $length;
}

echo $total;
?>
</pre>