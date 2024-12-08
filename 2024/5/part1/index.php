<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

[$rules, $updates] = explode("\n\n", $content);

$rules = explode("\n", $rules);
$updates = explode("\n", $updates);

foreach ($updates as $uKey => $update) {
    $pages = explode(',', $update);

    for ($i = 0; $i < count($pages)-1; $i++) {
        for ($j = $i+1; $j < count($pages); $j++) {
            $rule = $pages[$i]."|".$pages[$j];
            
            if (! in_array($rule, $rules)) {
                unset($updates[$uKey]);
                continue 3;
            }
        }
    }
}

$total = 0;
foreach ($updates as $update) {
    $pages = explode(',', $update);
    
    $total += $pages[(count($pages)-1)/2];
}

echo $total;
// dd(count($updates));