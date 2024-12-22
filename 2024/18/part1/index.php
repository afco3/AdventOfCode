<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$map = [];

for ($x = 0; $x <= 70; $x++) {
    for ($y = 0; $y <= 70; $y++) {
        $map[$x][$y] = '.';
    }
}

foreach ($content as $coord) {
    $coord = explode(',', $coord);

    $map[$coord[0]][$coord[1]] = '#';
}

$results = [];

walk(0, 0, $map, []);

function walk($x, $y, $map, $way) {
    global $results;
    $map[$x][$y] = '<span style="color:red">O</span>';

    $way[] = $x.'_'.$y;

    dump(count($way));

    if ($x == 70 && $y == 70) {
        dd('oui');
        $results[] = $way;
        return;
    }

    $possibility = [];

    if (isset($map[$x-1][$y]) && $map[$x-1][$y] == '.') {
        $possibility['up']['x'] = $x-1;
        $possibility['up']['y'] = $y;
    }
    if (isset($map[$x][$y+1]) && $map[$x][$y+1] == '.') {
        $possibility['right']['x'] = $x;
        $possibility['right']['y'] = $y+1;
    }
    if (isset($map[$x+1][$y]) && $map[$x+1][$y] == '.') {
        $possibility['down']['x'] = $x+1;
        $possibility['down']['y'] = $y;
    }
    if (isset($map[$x][$y-1]) && $map[$x][$y-1] == '.') {
        $possibility['left']['x'] = $x;
        $possibility['left']['y'] = $y-1;
    }


    foreach ($possibility as $pos) {
        walk($pos['x'], $pos['y'], $map, $way);
    }

    return;
}

dd($results);


displayContent($map);



function displayContent($content) {
    foreach ($content as $k => $v) {
        $content[$k] = implode('', $v);
    }

    dump(implode("\n", $content));
}