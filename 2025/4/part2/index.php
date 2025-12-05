<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$lines = explode("\n", $content);

foreach ($lines as $key => $line) {
    $lines[$key] = str_split($line);
}

$display = $lines;

display($display);
dump("<br>");

$count = 0;

$continue = true;
while ($continue) {
    $continue = false;
    foreach ($lines as $x => $cells) {
        foreach ($cells as $y => $cell) {
            if ($lines[$x][$y] != "@") continue;
            $nbAround = 0;
            // dump($lines[$x][$y]);
            if (isset($lines[$x+1][$y]) && $lines[$x+1][$y] == "@") $nbAround++;
            if (isset($lines[$x-1][$y]) && $lines[$x-1][$y] == "@") $nbAround++;
            if (isset($lines[$x][$y+1]) && $lines[$x][$y+1] == "@") $nbAround++;
            if (isset($lines[$x][$y-1]) && $lines[$x][$y-1] == "@") $nbAround++;
            if (isset($lines[$x+1][$y+1]) && $lines[$x+1][$y+1] == "@") $nbAround++;
            if (isset($lines[$x-1][$y-1]) && $lines[$x-1][$y-1] == "@") $nbAround++;
            if (isset($lines[$x+1][$y-1]) && $lines[$x+1][$y-1] == "@") $nbAround++;
            if (isset($lines[$x-1][$y+1]) && $lines[$x-1][$y+1] == "@") $nbAround++;

            // dump($x . ' ' . $y . ' : ' . $nbAround);

            if ($nbAround <= 3) {
                $continue = true;
                $count++;
                $display[$x][$y] = "x";
            }
        }
    }

    display($display);
    $lines = $display;
}


dd($count);



function display($lines) {
    dump("<br>");
    foreach ($lines as $cells) {
        dump(implode(' ', $cells));
    }
    dump("<br>");
}