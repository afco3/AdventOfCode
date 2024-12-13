<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

// dd($content);

$partition = [];

$id = 0;
$emptyPlace = false;
foreach (str_split($content) as $num) {
    if ($emptyPlace) {
        $partition = array_merge($partition, array_fill(0, (int) $num, "."));
    } else {
        $partition = array_merge($partition, array_fill(0, (int) $num, $id));
        $id ++;
    }

    $emptyPlace = !$emptyPlace;
}

while (isset(array_count_values($partition)['.'])) {
    dump(array_count_values($partition)['.']);
    $char = array_pop($partition);
    if ($char === '.') continue;

    $partition[array_search('.', $partition)] = $char;

}

$total = 0;
foreach ($partition as $key => $num) {
    $total += ($key*$num);
}

dd($total);