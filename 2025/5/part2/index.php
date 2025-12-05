<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$ranges = explode("\n", $content);

$freshIds = [];

$count = 0;
for ($i = 0; $i < count($ranges); $i++) {
    if (! isset($ranges[$i])) continue;

    $range = $ranges[$i];
    [$start, $end] = explode('-', $range);

    for ($j = 0; $j < $i; $j++) {
        if (! isset($ranges[$j])) continue;

        $r = $ranges[$j];
        [$s, $e] = explode('-', $r);

        if ($s >= $strat && $s <= $end && $e >= $strat && $e <= $end) {
            $ranges[] = $start.'-'.$s;
            $ranges[] = $e.'-'.$end;

        } else if ($s >= $strat && $s <= $end) {
            dump("aa");
        } else if ($e >= $strat && $e <= $end) {
            dump("aaa");
        }
    }

    $count += ($end-$start)+1;
}

dd(array_unique($freshIds));