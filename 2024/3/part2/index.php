<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$total = 0;
foreach (explode('do()', $content) as $do) {
    $do = explode('don\'t()', $do)[0];

    preg_match_all("/mul\([0-9]+\,[0-9]+\)/", $do, $matches);
        
    foreach ($matches[0] as $s) {
        $s = str_replace(['mul', '(', ')'], '', $s);

        $total += array_product(explode(',', $s));
    }
}

echo $total;



