<?php
include "../../../includes/debug.php";
ini_set('memory_limit', '1024M');
set_time_limit(3600);

dump("2");
flush();
ob_flush();

$tab = [];

$delta = [];

// dump("maxX : " . $maxX);
// dump("maxY : " . $maxY);

// $t = array_fill(0, $maxY, '.');

// $tc = array_fill(0, $maxX, $t);

// dd($tc);

// for ($x=0; $x <= $maxX+1; $x++) {
//     for ($y=0; $y <= $maxY+1; $y++) {
//         $tab[$x][$y] = ". ";
//     }
    
//     dump("x : " . $x);
//     flush();
//     ob_flush();

// }

dump("3");
flush();
ob_flush();

foreach ($points as $key => $point) {
    if ($key == 0) $previous = $points[count($points)-1];
    else $previous = $points[$key-1];

    if ($previous[0] != $point[0]) {
        for ($i=min($previous[0], $point[0]); $i < max($previous[0], $point[0]); $i++) {
            if (isset($tab[$i][$point[1]]) && $tab[$i][$point[1]] != "# ") $tab[$i][$point[1]] = "X ";
        }
    } else {
        for ($i=min($previous[1], $point[1]); $i < max($previous[1], $point[1]); $i++) {
            if (isset($tab[$point[0]][$i]) && $tab[$point[0]][$i] != "# ") $tab[$point[0]][$i] = "X ";
        }
    }

    $tab[$point[0]][$point[1]] = "# ";
}

dump("4");
flush();
ob_flush();

for ($i=0; $i < $maxX; $i++) {
    for ($j=0; $j < $maxY; $j++) {
        echo ($tab[$i][$j] ?? ".") . " ";
    }
    echo "<br>";
    flush();
    ob_flush();
}

// display($tab, true);

dd($delta);