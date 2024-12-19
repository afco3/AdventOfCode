<?php
set_time_limit(3600*24);
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

$hasDeadEnd = true;
while ($hasDeadEnd) {
    $hasDeadEnd = false;
    foreach ($content as $x => $c) {
        foreach ($c as $y => $v) {
            if (in_array($v, ["#", "S", "E"])) continue;
            $hcount = substr_count($content[$x-1][$y].$content[$x+1][$y].$content[$x][$y+1].$content[$x][$y-1], '#');

            if ($hcount >= 3) {
                $content[$x][$y] = '#';
                $hasDeadEnd = true;
            }
        }
    }
}

$lines = [];

// displayContent($content);
// dd('');

// $i = 0;

$maxCost = 50000000; // 115476

walk($start['x'], $start['y'], 'right', 0, $content, $start['x'] .'-'. $start['y']);

function walk($x, $y, $dir, $cost, $content, $line) {
    global $lines, $maxCost;
    // dump($i);

    // dump($x .' '. $y);

    // if ($i > 50000000) {
    //     displayContent($content);
    //     exit;
    // }
    // if (($i % 500000000) == 0) {
    //     displayContent($content);
    // }

    // $i++;

    if ($cost > $maxCost) return ;

    if ($content[$x][$y] == 'E') {
        $lines[$line.'_'.$x.'-'.$y] = $cost;
        displayContent($content);
        dump(count($lines));
        // dd($lines);
        $tmpLines = $lines;
        sort($tmpLines);
        $maxCost = $tmpLines[0];
        dump($maxCost);
        // dd($lines);

        return ;
    }

    $content[$x][$y] = '<span style="color:red">x</span>';

    $possibility = [];

    if ($content[$x-1][$y] != '#' && $content[$x-1][$y] != '<span style="color:red">x</span>') {
        $possibility['up']['x'] = $x-1;
        $possibility['up']['y'] = $y;
    }
    if ($content[$x][$y+1] != '#' && $content[$x][$y+1] != '<span style="color:red">x</span>') {
        $possibility['right']['x'] = $x;
        $possibility['right']['y'] = $y+1;
    }
    if ($content[$x+1][$y] != '#' && $content[$x+1][$y] != '<span style="color:red">x</span>') {
        $possibility['down']['x'] = $x+1;
        $possibility['down']['y'] = $y;
    }
    if ($content[$x][$y-1] != '#' && $content[$x][$y-1] != '<span style="color:red">x</span>') {
        $possibility['left']['x'] = $x;
        $possibility['left']['y'] = $y-1;
    }

    foreach ($possibility as $key => $pos) {
        walk($pos['x'], $pos['y'], $key, ($key != $dir ? 1001 : 1) + $cost, $content, $line.'_'.$x.'-'.$y);
    }

    return ;
}

sort($lines);

dd($lines);



function displayContent($content) {
    foreach ($content as $k => $v) {
        $content[$k] = implode('', $v);
    }

    dump(implode("\n", $content));
}