<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$banks = explode("\n", $content);

$count = 0;
foreach ($banks as $batteries) {
    $batteries = str_split($batteries);

    // dump(array_slice($batteries, 0, count($batteries)-1));

    $joltage = "";
    for ($i = 11; $i >= 0; $i--) {
        $max = max(array_slice($batteries, 0, count($batteries)-$i));
        
        $joltage .= $max;

        $maxKey = -1;

        foreach ($batteries as $key => $batterie) {
            if ($batterie == $max) {
                $maxKey = $key;
                break;
            }
        }

        $batteries = array_slice($batteries, $maxKey+1);

        // dump($joltage);

    }
    $count += (int) $joltage;
}

dd($count);