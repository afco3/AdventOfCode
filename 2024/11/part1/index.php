<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$stones = explode(' ', $content);

for ($i=0; $i<25; $i++) {
    dump($i);
    $newStones = [];
    foreach ($stones as $stone) {
        if ($stone == 0) {
            $newStones[] = 1;
            continue;
        }

        $len = strlen($stone);
        if ($len%2 == 0) {
            $split = str_split($stone, $len/2);
            $newStones[] = (string) ((int) $split[0]);
            $newStones[] = (string) ((int) $split[1]);
            continue;
        }

        $newStones[] = $stone*2024;
    }
    $stones = $newStones;
}

dd(count($stones));