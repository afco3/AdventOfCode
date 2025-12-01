<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$instructions = explode("\n", $content);

$position = 50;
$count = 0;
foreach ($instructions as $instruction) {
    $direction = substr($instruction, 0, 1);
    $number = (int) substr($instruction, 1);

    if ($direction == "L") {
        $position -= $number;

        while ($position < 0) {
            $position += 100;
        }
    } else {
        $position += $number;
        $position %= 100;
    }

    if ($position == 0) {
        $count++;
    }
}

dd($count);