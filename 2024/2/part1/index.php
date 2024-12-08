<?php

$content = file_get_contents("./input.txt");

$reports = explode("\n", $content);

$total = 0;
foreach ($reports as $levels) {
    $levels = explode(' ', $levels);
    
    $tmp1 = $levels;
    $tmp2 = $levels;

    sort($tmp1);
    rsort($tmp2);

    if (! ($tmp1 === $levels || $tmp2 === $levels)) continue;

    for ($i = 0; $i < count($levels)-1; $i++) {
        $d = abs($levels[$i]-$levels[$i+1]);
        if ($d < 1 || $d > 3) continue 2;
    }


    $total++;
}

echo $total;