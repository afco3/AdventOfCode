<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$lines = explode("\n", $content);

foreach ($lines as $key => $line) {
    $lines[$key] = str_split($line);
}

$tmp = [];
$calc = "";
for ($i=count($lines[0])-1; $i >= 0 ; $i--) {
    $num = "";
    foreach ($lines as $line) {
        $num .= $line[$i];
    }
    $calc .= $num;
    if (empty(str_replace(' ', '', $num)) || $i == 0) {
        $tmp[] = preg_replace('/\s{2,}/', ' ', trim($calc));
        $calc = "";
    }
}
$lines = $tmp;

$count = 0;
foreach ($lines as $calc) {
    $symbol = substr($calc, -1);

    $calc = explode(' ', trim(substr($calc, 0, -1)));

    if ($symbol == '+') {
        $result = array_sum($calc);
    } else {
        $result = array_product($calc);
    }

    $count += $result;
}

dd($count);