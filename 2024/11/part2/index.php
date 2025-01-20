<?php
set_time_limit(3600*24);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$stones = explode(' ', $content);
$result = 0;
$cache = [];

foreach ($stones as $key => $stone) {
    dump('s : '.$key);
    $result += walk($stone, 0);
}

dd($result);

function walk($stone, $step, $way = []) {
    global $cache;

    $way[] = $stone;

    if (isset($cache[$stone.'_'.$step])) return $cache[$stone.'_'.$step];

    if ($step >= 75) return 1;

    if ($stone == 0) {
        $cache[$stone.'_'.$step] = walk(1, $step+1, $way);
        return $cache[$stone.'_'.$step];
    }

    $len = strlen($stone);
    if ($len%2 == 0) {
        $split = str_split($stone, $len/2);
        $t0 = (string) ((int) $split[0]);
        $t1 = (string) ((int) $split[1]);

        $count = walk($t0, $step+1, $way);
        $count += walk($t1, $step+1, $way);
        
        $cache[$stone.'_'.$step] = $count;
        return $count;
    }

    $cache[$stone.'_'.$step] = walk($stone*2024, $step+1, $way);
    return $cache[$stone.'_'.$step];
}