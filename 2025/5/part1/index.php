<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

[$ranges, $ingredients] = explode("\n\n", $content);

$freshIds = [];

$ranges = explode("\n", $ranges);
$ingredients = explode("\n", $ingredients);

$count = 0;
foreach ($ingredients as $ingredient) {
    foreach ($ranges as $range) {
        [$start, $end] = explode('-', $range);

        if ($ingredient >= $start && $ingredient <= $end) {
            // dump($ingredient);
            $count++;
            break;
        }
    }
}

// foreach ($ranges as $range) {
//     [$start, $end] = explode('-', $range);
//     $range = array_fill($start, ($end-$start)+1, '1');
//     // dump($range);

//     $freshIds = array_replace($freshIds, $range);
// }

// // dump($freshIds);

// $count = 0;
// foreach ($ingredients as $ingredient) {
//     // dump($ingredient);
//     if (isset($freshIds[$ingredient])) {
//         // dump("++");
//         $count++;
//     }
// }

dd($count);