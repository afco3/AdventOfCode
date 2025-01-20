<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$stones = explode(' ', $content);

$newStones = [];

for ($i = 0; $i < 25; $i++) {
    dump('i : '.$i);
    foreach ($stones as $key => $stone) {
        if ($stone == 0) {
            // $stones[$key] = 1;
            $newStones[] = 1;
            continue;
        }

        $len = strlen($stone);
        if ($len%2 == 0) {
            // $newStones = str_split($stone, $len/2);
            // unset($stones[$key]);
            // array_splice($stones, $key, 0, $newStones);
            $tmp = str_split($stone, $len/2);
            $newStones[] = $tmp[0];
            $newStones[] = $tmp[1];
            continue;
        }

        // $stones[$key] = $stone*2024;
        $newStones[] = $stone*2024;
    }

    $stones = $newStones;
}

dump(count($stones));
dd($stones);