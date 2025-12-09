<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n\n", $content)[0];
$ranges = explode("\n", $content);

foreach ($ranges as $key => $range) {
    $ranges[$key] = explode('-', $range);
}

usort($ranges, function ($a, $b) {
    return $a[0] > $b[0];
});

$tmp = [array_shift($ranges)];

foreach ($ranges as $range) {
    $lastTmpRangeKey = count($tmp)-1;
    $lastTmpRange = $tmp[$lastTmpRangeKey];

    if ($range[0] > $lastTmpRange[1]) {
        $tmp[] = $range;
        continue;
    }

    if ($range[1] > $lastTmpRange[1]) {
        $tmp[$lastTmpRangeKey][1] = $range[1];
    }
}

$ranges = $tmp;

$count = 0;
foreach ($ranges as $range) {
    $count += ($range[1]-$range[0])+1;
}

dd($count);