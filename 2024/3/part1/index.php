<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

preg_match_all("/mul\([0-9]+\,[0-9]+\)/", $content, $matches);

$total = 0;
foreach ($matches[0] as $s) {
    $s = str_replace(['mul', '(', ')'], '', $s);

    $total += array_product(explode(',', $s));
}

echo $total;