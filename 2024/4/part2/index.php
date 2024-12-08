<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$total = 0;
foreach ($content as $x => $v) {
    $content[$x] = str_split($v);
}

foreach ($content as $x => $letters) {
    foreach ($letters as $y => $letter) {
        if ($letter != 'A') continue;

        if (($content[$x+1][$y+1] == 'M' && $content[$x-1][$y-1] == 'S' || $content[$x+1][$y+1] == 'S' && $content[$x-1][$y-1] == 'M')
        && ($content[$x+1][$y-1] == 'M' && $content[$x-1][$y+1] == 'S' || $content[$x+1][$y-1] == 'S' && $content[$x-1][$y+1] == 'M')) $total++;
    }
}

echo $total;