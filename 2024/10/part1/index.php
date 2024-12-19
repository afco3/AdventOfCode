<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$start = [];

foreach ($content as $x => $c) {
    $content[$x] = str_split($c);

    if (str_contains($c, '0')) {
        $starts[] = [
            'x' => $x,
            'y' => strpos($c, '0'),
        ];
    }
}

foreach ($starts as $start) {
    walk($start['x'], $start['y']);
}

$hikes = 0;

function walk($x, $y) {
    global $hikes, $content;
    $height = $content[$x][$y];


    if ($height == 9) {
        dump("9");
        $hikes++;
        return;
    }

    $possibility = [];

    if ($content[$x-1][$y] == $height+1) {
        $possibility['up']['x'] = $x-1;
        $possibility['up']['y'] = $y;
    }
    if ($content[$x][$y+1] == $height+1) {
        $possibility['right']['x'] = $x;
        $possibility['right']['y'] = $y+1;
    }
    if ($content[$x+1][$y] == $height+1) {
        $possibility['down']['x'] = $x+1;
        $possibility['down']['y'] = $y;
    }
    if ($content[$x][$y-1] == $height+1) {
        $possibility['left']['x'] = $x;
        $possibility['left']['y'] = $y-1;
    }

    foreach ($possibility as $pos) {
        walk($pos['x'], $pos['y'], $content);
    }
}

dd($hikes);

dd($content);