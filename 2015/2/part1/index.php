<?php

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$total = 0;
foreach($content as $present){
    // var_dump($present);
    $dimensions = explode("x", $present);
    sort($dimensions);
    $dimensions = array_map('intval', $dimensions);

    $total += 2*$dimensions[0]*$dimensions[1]+2*$dimensions[1]*$dimensions[2]+2*$dimensions[0]*$dimensions[2] + $dimensions[0]*$dimensions[1];
}

echo $total;