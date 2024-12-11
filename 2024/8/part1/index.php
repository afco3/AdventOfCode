<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$antennasTypes = [];

foreach ($content as $x => $c) {
    $c = str_split($c);
    $content[$x] = $c;

    foreach ($c as $y => $case) {
        if ($case == '.') continue;

        if (! isset($antennasTypes[$case])) $antennasTypes[$case] = [];
        $antennasTypes[$case][] = [$x, $y];
    }
}

$maxX = count($content)-1;
$maxY = count($content[0])-1;

$antinodes = [];

foreach ($antennasTypes as $type => $antennas) {
    foreach ($antennas as $antenna) {
        $x = $antenna[0];
        $y = $antenna[1];

        foreach ($antennas as $tmpAntenna) {
            if ($antenna === $tmpAntenna) continue;
            $tmpX = $tmpAntenna[0];
            $tmpY = $tmpAntenna[1];

            $dx = abs($x-$tmpX);
            $dy = abs($y-$tmpY);
            
            $newX = array_values(array_diff([$x+$dx, $x-$dx], [$tmpX]))[0];
            $newY = array_values(array_diff([$y+$dy, $y-$dy], [$tmpY]))[0];
            if ($newX < 0 || $newY < 0 || $newX > $maxX || $newY > $maxY) continue;

            $antinodes[$newX.$newY] = "";
        }
    }
}

echo count($antinodes);