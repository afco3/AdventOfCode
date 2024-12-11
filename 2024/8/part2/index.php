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
            
            $potentialX = [];
            $potentialY = [];

            for ($i = $maxX*-1; $i < $maxX; $i++) {
                $newX = $x+($dx*$i);
                if ($newX < 0 || $newX > $maxX || $newX == $tmpX) continue;
                
                $newY = $y+($dy*$i);
                if ($newY < 0 || $newY > $maxY || $newY == $tmpY) continue;
                
                $antinodes[$newX.$newY] = "";
                $content[$newX][$newY] = "#";
            }


        }
    }
}

foreach ($content as $x => $c) {
    $content[$x] = implode($c);
}

dd($content);

echo count($antinodes);