<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$ranges = explode("\n", $content);

$count = 0;
for ($i = 0; $i < count($ranges); $i++) {
    if (! isset($ranges[$i])) continue;

    $range = $ranges[$i];
    [$start, $end] = explode('-', $range);

    $d = $i == 3;

    // if ($d) dump($range);
    // if ($d) dump("<br>");

    for ($j = 0; $j < $i; $j++) {
        if (! isset($ranges[$j])) continue;

        $r = $ranges[$j];
        [$s, $e] = explode('-', $r);
        // if ($d) dump("<br>");

        // if ($d) dump($r);
        // if ($d) dump($start);
        // if ($d) dump($end);
        // if ($d) dump($s);
        // if ($d) dump($e);
        // if ($d) dump("<br>");

        if ($s >= $start && $s <= $end && $e >= $start && $e <= $end) {
            // if ($d) dump("1");
            $count -= ($e-$s)+1;
            unset($ranges[$j]);
        } else if ($start >= $s && $start <= $e && $end >= $s && $end <= $e) {
            // if ($d) dump("2");
            unset($ranges[$i]);
            continue 2;
        } else if ($s >= $start && $s <= $end) {
            // if ($d) dump("3");
            $end = $s-1;
            $ranges[$i] = $start . '-' . $end;
            // if ($d) dump($ranges[$i]);
        } else if ($e >= $start && $e <= $end) {
            // if ($d) dump("4");
            $start = $e+1;
            $ranges[$i] = $start. '-' . $end;
            // if ($d) dump($ranges[$i]);
        }
        // if ($d) dump("<br>");
        // if ($d) dump("<br>");
    }

    $count += ($end-$start)+1;
}

// dump("<br>");
// dump("<br>");
// dump("<br>");
// dump($ranges);

dd($count);