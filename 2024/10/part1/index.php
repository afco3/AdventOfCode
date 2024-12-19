<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$start = [];

foreach ($content as $x => $c) {
    $content[$x] = str_split($c);

    foreach ($content[$x] as $y => $l) {
        if ($l != 0) continue;
        $starts[] = [
            'x' => $x,
            'y' => $y,
        ];
    }
}

$hikes = [];
// dd($starts);
foreach ($starts as $start) {
    walk($start['x'], $start['y'], $start, $content);
}


function walk($x, $y, $start, $content) {
    global $hikes;
    $height = $content[$x][$y];

    if ($height == 9) {
        $hikes[$start['x'].','.$start['y'].'_'.$x.','.$y] = $start['x'].','.$start['y'].'_'.$x.','.$y;
        return;
    }

    $possibility = [];

    if (isset($content[$x-1][$y]) && $content[$x-1][$y] == $height+1) {
        $possibility['up']['x'] = $x-1;
        $possibility['up']['y'] = $y;
    }
    if (isset($content[$x][$y+1]) && $content[$x][$y+1] == $height+1) {
        $possibility['right']['x'] = $x;
        $possibility['right']['y'] = $y+1;
    }
    if (isset($content[$x+1][$y]) && $content[$x+1][$y] == $height+1) {
        $possibility['down']['x'] = $x+1;
        $possibility['down']['y'] = $y;
    }
    if (isset($content[$x][$y-1]) && $content[$x][$y-1] == $height+1) {
        $possibility['left']['x'] = $x;
        $possibility['left']['y'] = $y-1;
    }

    foreach ($possibility as $pos) {
        walk($pos['x'], $pos['y'], $start, $content);
    }

    return;
}

dump(count($hikes));
dd($hikes);

dd($content);



function displayContent($content) {
    foreach ($content as $k => $v) {
        $content[$k] = implode('', $v);
    }

    dump(implode("\n", $content));
}