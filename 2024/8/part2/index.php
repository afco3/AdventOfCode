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

// $antennasTypes = array_slice($antennasTypes, 0, 2);

// dump($antennasTypes);

$antinodes = [];

foreach ($antennasTypes as $type => $antennas) {
    foreach ($antennas as $antenna) {
        $x = $antenna[0];
        $y = $antenna[1];

        foreach ($antennas as $tmpAntenna) {
            if ($antenna === $tmpAntenna) continue;
            $tmpX = $tmpAntenna[0];
            $tmpY = $tmpAntenna[1];

            $dx = $tmpX-$x;
            $dy = $tmpY-$y;

            $newX = $x;
            $newY = $y;

            while (true) {
                $newX = $newX+$dx;
                $newY = $newY+$dy;
                if ($newX > $maxX || $newY > $maxY || $newX < 0 || $newY < 0) break;
                
                $antinodes[$newX.' '.$newY] = "";
                $content[$newX][$newY] = "#";
            }

        }
    }
}

foreach ($content as $x => $c) {
    $content[$x] = implode($c);
}

dump($content);

echo count($antinodes);