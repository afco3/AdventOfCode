<?php

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$lumieres = [];

echo "<pre>";
foreach($content as $instruction){
    $words = explode(' ', $instruction);

    if ($words[0] == "turn" && $words[1] == "on") {
        $start = explode(',', $words[2]);
        $end = explode(',', $words[4]);

        // $rangex = range($start[0], $end[0]);
        // $rangey = range($start[1], $end[1]);
        // $ligne = array_fill_keys($rangey, 1);
        // $rectangle = array_fill_keys($rangex, $ligne);

        // $lumieres = array_merge($lumieres, $rectangle);

        for ($i=$start[0]; $i <= $end[0]; $i++) {
            for ($j=$start[1]; $j <= $end[1]; $j++) {
                $lumieres[$i][$j] = 1;
            }
        }
    } else if ($words[0] == "turn" && $words[1] == "off") {
        $start = explode(',', $words[2]);
        $end = explode(',', $words[4]);

        // $rangex = range($start[0], $end[0]);
        // $rangey = range($start[1], $end[1]);
        // $ligne = array_fill_keys($rangey, 0);
        // $rectangle = array_fill_keys($rangex, $ligne);

        // $lumieres = array_merge($lumieres, $rectangle);

        for ($i=$start[0]; $i <= $end[0]; $i++) {
            for ($j=$start[1]; $j <= $end[1]; $j++) {
                $lumieres[$i][$j] = 0;
            }
        }
    } else {
        $start = explode(',', $words[1]);
        $end = explode(',', $words[3]);
        
        for ($i=$start[0]; $i <= $end[0]; $i++) {
            for ($j=$start[1]; $j <= $end[1]; $j++) {
                if (isset($lumieres[$i][$j]) && $lumieres[$i][$j] == 1) {
                    $lumieres[$i][$j] = 0;
                } else {
                    $lumieres[$i][$j] = 1;
                }
            }
        }
    }

}

// $total = array_sum(array_map(function($var) {
//     return array_sum($var);
//   }, $lumieres));

// echo $total . "";
$total = 0;
for($i = 0; $i < 1000; $i++) {
    for($j = 0; $j < 1000; $j++) {
        $total += isset($lumieres[$i][$j]) ? $lumieres[$i][$j] : 0;
        // echo isset($lumieres[$i][$j]) ? $lumieres[$i][$j] : 0;
    }
    // echo "\n";
}
echo $total . "";
// var_dump($lumieres);
echo "</pre>";