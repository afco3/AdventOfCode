<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$lines = explode("\n", $content);
$sPos = strpos($lines[0], "S");
$lines = array_map(fn ($a) => str_split($a), $lines);
$lines[0][$sPos] = 1;

for ($x=0; $x < count($lines)-1; $x++) {
    $line = $lines[$x];
    $nextLine = $lines[$x+1];
    for ($y=0; $y < count($line); $y++) {
        if (! is_int($line[$y])) continue;

        if ($nextLine[$y] == "^") {
            $nextLine[$y-1] = $line[$y] + ((int) $nextLine[$y-1]);
            $nextLine[$y+1] = $line[$y] + ((int) $nextLine[$y+1]);
        } else {
            $nextLine[$y] = $line[$y] + ((int) $nextLine[$y]);
        }
    }
    $lines[$x+1] = $nextLine;
}

display($lines);

$count = 0;
foreach ($lines[count($lines)-1] as $val) {
    if (is_int($val)) $count += $val;
}
dd($count);






















































$content = file_get_contents("./input.txt");

// dump(substr_count($content, "^"));

$lines = explode("\n", $content);
$start = strpos($lines[0], "S");
$lines = array_map(fn ($a) => str_split($a), $lines);

// display($lines);
// dump($start);
// dump($lines[0][7]);
dd(walk($lines, 0, $start));

$debug = [];

function walk($lines, $x, $y) {
    global $debug;
    if (! isset($lines[$x+1])) {
        $t = date('H:i:s');
        if (! isset($debug[$t])) {
            $debug[$t] = 0;
            display($lines);
            dump($debug);
            flush();
            ob_flush();
        }
        $debug[$t]++;
        return 1;
    }

    if ($lines[$x+1][$y] == '.') {
        $lines[$x+1][$y] = "|";
        return walk($lines, $x+1, $y);
    } else if ($lines[$x+1][$y] == "^") {
        $lines[$x+1][$y-1] = "|";
        $lines[$x+1][$y+1] = "|";
        return walk($lines, $x+1, $y-1) + walk($lines, $x+1, $y+1);
    }
}


// dd($count);