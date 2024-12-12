<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

// dd($content);

$partition = "";

$id = 0;
$emptyPlace = false;
foreach (str_split($content) as $num) {
    if ($emptyPlace) {
        $partition .= str_repeat(".", (int) $num);
    } else {
        $partition .= str_repeat($id, (int) $num);
        $id ++;
    }

    if ($id > 9) $id = 0;
    $emptyPlace = !$emptyPlace;
}

$partition = str_split($partition);

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