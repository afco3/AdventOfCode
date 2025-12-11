<?php
include "../../../includes/debug.php";
ini_set('memory_limit', '1024M');
set_time_limit(0);

$content = file_get_contents("./input.txt");

$points = explode("\n", $content);

foreach ($points as $key => $point) {
    $points[$key] = explode(',', $point);
}

// dd($points);

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

    // dump($previous[0] != $point[0]);
    
    if ($previous[0] != $point[0]) {
        for ($i=min($previous[0], $point[0]); $i < max($previous[0], $point[0]); $i++) {
            if ($tab[$i][$point[1]] != "#") $tab[$i][$point[1]] = "X";
        }
    } else {
        for ($i=min($previous[1], $point[1]); $i < max($previous[1], $point[1]); $i++) {
            if ($tab[$point[0]][$i] != "#") $tab[$point[0]][$i] = "X";
        }
    }

    $tab[$point[0]][$point[1]] = "#";
}

dump("4");
flush();
ob_flush();

$pointsByY = [];
foreach ($tab as $x => $v) {
    foreach ($v as $y => $unused)
    $pointsByY[$y][] = $x;
}

dump("5");
flush();
ob_flush();

$max = 0;

foreach ($points as $key => $point) {
    foreach ($points as $point2) {
        if ($point == $point2) continue;
        
        $air = (abs($point[0]-$point2[0])+1) * (abs($point[1]-$point2[1])+1);

        if ($air <= $max) continue;

        $x1 = min($point[0], $point2[0])+1;
        $x2 = max($point[0], $point2[0])-1;
        $y1 = min($point[1], $point2[1])+1;
        $y2 = max($point[1], $point2[1])-1;

        if ($x1 > $x2) continue;
        if ($y1 > $y2) continue;


        // if (isset($tab[$x1]))

        // dump($x1);
        // dump($x2);
        // dump($y1);
        // dump($y2);

        // $allX = array_keys(array_fill($x1, ($x2-$x1)+1, false));
        // dump($allX); // y1 et y2
        
        // if (! empty($pointsByY[$y1]) && ! empty(array_intersect($allX, array_keys($pointsByY[$y1])))) continue;


        // $allY = array_keys(array_fill($y1, ($y2-$y1)+1, false));
        // dump($allY); // x1 et x2
        // if (! empty($tab[$x1]) && ! empty(array_intersect($allY, array_keys($tab[$x1])))) continue;

        for ($x=$x1; $x <= $x2; $x++) {
            if (isset($tab[$x][$y1])) continue 2;
            if (isset($tab[$x][$y2])) continue 2;
        }
        
        for ($y=$y1; $y <= $y2; $y++) {
            if (isset($tab[$x1][$y])) continue 2;
            if (isset($tab[$x2][$y])) continue 2;
        }

        $max = $air;
        // dd("");

        // dump($point);
        // dd($point2);

        // $delta[implode(',', $point).";".implode(',', $point2)] = $air;
    }

    if (($key % 100) === 0) {
        dump(date('H:i:s') . ' -> key : ' . $key . ' - max : ' . $max);
        flush();
        ob_flush();
    }

}

dump("6");
flush();
ob_flush();



dd($max);




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