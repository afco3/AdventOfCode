<?php

$content = file_get_contents("./input.txt");

$couple = explode("\n", $content);

$left = [];
$right = [];
foreach ($couple as $key => $numbers) {
    $numbers = explode(' ', $numbers);
    
    $left[] = $numbers[0];
    $right[] = $numbers[1];
}

sort($left);
sort($right);

$total = 0;
foreach ($left as $k => $n) {
    $total += abs($n-$right[$k]);
}

echo $total;