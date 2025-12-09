<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$lines = explode("\n", $content);
$lines[0] = str_replace("S", "|", $lines[0]);
$lines = array_map(fn ($a) => str_split($a), $lines);

$count = 0;
for ($x=0; $x < count($lines)-1; $x++) {
    $line = $lines[$x];
    $nextLine = $lines[$x+1];
    for ($y=0; $y < count($line); $y++) {
        if ($line[$y] != "|") continue;

        if ($nextLine[$y] == ".") $nextLine[$y] = "|";
        else if ($nextLine[$y] == "^") {
            $nextLine[$y-1] = "|";
            $nextLine[$y+1] = "|";
            $count++;
        }
    }
    $lines[$x+1] = $nextLine;
}

dd($count);