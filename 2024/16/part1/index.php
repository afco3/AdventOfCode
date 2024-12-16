<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$start = [];
$end = [];

foreach ($content as $k => $v) {
    $content[$k] = str_split($v);

    if (str_contains($v, "S")) {
        $start['x'] = $k;
        $start['y'] = strlen(explode("S", $v)[0]);
    }
    if (str_contains($v, "E")) {
        $end['x'] = $k;
        $end['y'] = strlen(explode("E", $v)[0]);
    }
}

$lines = [];

displayContent($content);
// dd('');

$i = 0;

walk($start['x'], $start['y'], 'left', 0, $content, $start['x'] .'-'. $start['y']);

function walk($x, $y, $dir, $cost, $content, $line) {
    global $lines, $i;
    dump($i);
    $i++;

    if ($content[$x][$y] == 'E') {
        displayContent($content);
        dump(count($lines));
        $lines[$line.'_'.$x.'-'.$y] = $cost;
        return $cost;
    }

    $content[$x][$y] = 'x';

    $possibility = [];

    if ($content[$x-1][$y] != '#' && $content[$x-1][$y] != 'x') {
        $possibility['up']['x'] = $x-1;
        $possibility['up']['y'] = $y;
    }
    if ($content[$x+1][$y] != '#' && $content[$x+1][$y] != 'x') {
        $possibility['down']['x'] = $x+1;
        $possibility['down']['y'] = $y;
    }
    if ($content[$x][$y+1] != '#' && $content[$x][$y+1] != 'x') {
        $possibility['right']['x'] = $x;
        $possibility['right']['y'] = $y+1;
    }
    if ($content[$x][$y-1] != '#' && $content[$x][$y-1] != 'x') {
        $possibility['left']['x'] = $x;
        $possibility['left']['y'] = $y-1;
    }

    foreach ($possibility as $key => $pos) {
        walk($pos['x'], $pos['y'], $key, ($key != $dir ? 1001 : 1) + $cost, $content, $line.'_'.$x.'-'.$y);
    }

    return $cost;
}

sort($lines);

dd($lines);



function displayContent($content) {
    foreach ($content as $k => $v) {
        $content[$k] = implode('', $v);
    }

    dump(implode("\n", $content));
}