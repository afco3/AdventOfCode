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
        if ($letter != 'X') continue;

        if ($content[$x][$y+1] == 'M' && $content[$x][$y+2] == 'A' && $content[$x][$y+3] == 'S') $total++;
        if ($content[$x][$y-1] == 'M' && $content[$x][$y-2] == 'A' && $content[$x][$y-3] == 'S') $total++;
        
        if ($content[$x+1][$y] == 'M' && $content[$x+2][$y] == 'A' && $content[$x+3][$y] == 'S') $total++;
        if ($content[$x-1][$y] == 'M' && $content[$x-2][$y] == 'A' && $content[$x-3][$y] == 'S') $total++;

        
        if ($content[$x+1][$y+1] == 'M' && $content[$x+2][$y+2] == 'A' && $content[$x+3][$y+3] == 'S') $total++;
        if ($content[$x-1][$y-1] == 'M' && $content[$x-2][$y-2] == 'A' && $content[$x-3][$y-3] == 'S') $total++;
        
        if ($content[$x+1][$y-1] == 'M' && $content[$x+2][$y-2] == 'A' && $content[$x+3][$y-3] == 'S') $total++;
        if ($content[$x-1][$y+1] == 'M' && $content[$x-2][$y+2] == 'A' && $content[$x-3][$y+3] == 'S') $total++;
    }
}

echo $total;