<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$points = explode("\n", $content);

$delta = [];
foreach ($points as $point) {
    foreach ($points as $point2) {
        if ($point == $point2) continue;

        $p1 = explode(',', $point);
        $p2 = explode(',', $point2);

        $delta[$point.";".$point2] = (abs($p1[0]-$p2[0])+1) * (abs($p1[1]-$p2[1])+1);
    }
}

arsort($delta);

dd($delta);