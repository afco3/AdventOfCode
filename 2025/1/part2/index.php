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
        if ($position == 0) {
            $count--;
        }

        $position -= $number;

        while ($position < 0) {
            $position += 100;
            
            $count++;
        }
        
        if ($position == 0) {
            $count++;
        }
    } else {
        $position += $number;
        
        if ($position == 0) {
            $count++;
        }

        $count += (int) ($position/100);

        $position %= 100;
    }
}

dd($count);