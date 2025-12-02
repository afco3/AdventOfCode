<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$count = 0;
foreach (explode(',', $content) as $range) {
    [$first, $last] = explode('-', $range);
    
    foreach (array_fill($first, ($last-$first)+1, 0) as $id => $unused) {
        $repeating = [];
        preg_match('/(\d{1,'.(strlen($id)/2).'})(\1+)/', $id, $repeating);

        if ($repeating[0] == $id && $repeating[1] == $repeating[2]) {
            // dump("match !");
            // dump($id);
            // dump($repeating);
            $count += $id;
        }
        
    }
}
dd($count);