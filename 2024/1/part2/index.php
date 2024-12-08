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

$right = array_count_values($right);


$total = 0;
foreach ($left as $n) {
    $total += $n * ($right[$n] ?? 0);
}

echo $total;