<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$lines = explode("\n", $content);

foreach ($lines as $key => $line) {
    $line = preg_replace('/\s+/', ' ', trim($line));
    $lines[$key] = explode(" ", $line);
}

$tmp = [];
for ($x=0; $x < count($lines); $x++) {
    for ($y=0; $y < count($lines[$x]); $y++) {
        $tmp[$y][$x] = $lines[$x][$y];
    }
}
$lines = $tmp;

$count = 0;
foreach ($lines as $calc) {
    $symbol = array_pop($calc);

    if ($symbol == '+') {
        $result = array_sum($calc);
    } else {
        $result = array_product($calc);
    }

    $count += $result;
}


dd($count);