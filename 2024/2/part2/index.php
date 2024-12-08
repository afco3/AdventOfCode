<?php

set_time_limit(3600);

$content = file_get_contents("./input.txt");

$reports = explode("\n", $content);

$total = 0;
foreach ($reports as $levels) {
    $levels = explode(' ', $levels);

    foreach ($levels as $key => $n) {
        $tmpLevels = $levels;

        unset($tmpLevels[$key]);
        $tmpLevels = array_values($tmpLevels);
        
        $tmp1 = $tmpLevels;
        $tmp2 = $tmpLevels;

        sort($tmp1);
        rsort($tmp2);

        if (! ($tmp1 === $tmpLevels || $tmp2 === $tmpLevels)) continue;

        for ($i = 0; $i < count($tmpLevels)-1; $i++) {
            $d = abs($tmpLevels[$i]-$tmpLevels[$i+1]);
            if ($d < 1 || $d > 3) continue 2;
        }

        $total++;
        continue 2;
    }


}

echo $total;