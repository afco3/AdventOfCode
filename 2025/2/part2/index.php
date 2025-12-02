<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$count = 0;
foreach (explode(',', $content) as $range) {
    [$first, $last] = explode('-', $range);

    foreach (array_fill($first, ($last-$first)+1, 0) as $id => $unused) {
        $repeating = [];

        for ($i = 0; $i < strlen($id); $i++) {
            preg_match('/(\d{1,'.$i.'})(\1+)/', $id, $repeating);

            if ($repeating[0] == $id) {
                // dump("match !");
                // dump($id);
                // dump($repeating);
                $count += $id;

                $i = 99999999999;
            }
        }
    }
}

dd($count);