<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

[$rules, $updates] = explode("\n\n", $content);

$rules = explode("\n", $rules);
$updates = explode("\n", $updates);

$incorrectUpdates = [];

foreach ($updates as $uKey => $update) {
    $pages = explode(',', $update);

    for ($i = 0; $i < count($pages)-1; $i++) {
        for ($j = $i+1; $j < count($pages); $j++) {
            $rule = $pages[$i]."|".$pages[$j];
            
            if (! in_array($rule, $rules)) {
                $tmp = $pages[$j];
                unset($pages[$j]);
                array_splice($pages, $i, 0, $tmp);

                $j = $i;

                $updates[$uKey] = implode(',', $pages);

                $incorrectUpdates[$uKey] = $uKey;
            }
        }
    }
}


$total = 0;
foreach ($incorrectUpdates as $uKey) {
    $pages = explode(',', $updates[$uKey]);
    
    $total += $pages[(count($pages)-1)/2];
}

echo $total;