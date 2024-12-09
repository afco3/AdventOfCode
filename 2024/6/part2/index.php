<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$guardPosition = strpos($content, '^');

$content = explode("\n", $content);
foreach ($content as $k => $v) {
    $content[$k] = str_split($v);
}

$guardPosition = [
    'x' => (int) ($guardPosition/(count($content[0])+1)),
    'y' => $guardPosition%(count($content[0])+1),
];

$total = 0;
foreach ($content as $obsX => $c) {
    foreach ($c as $obsY => $case) {
        if ($case !== ".") continue;
        
        $tmpGuardPosition = $guardPosition;
        $tmpContent = $content;

        $tmpContent[$obsX][$obsY] = "#";

        $direction = "up";
        $openedCase = [];
        $objectsHit = [];
        $isIn = true;
        while($isIn) {
            $x = $tmpGuardPosition['x'];
            $y = $tmpGuardPosition['y'];
            switch($direction) {
                case "up":
                    $x--;
                    $nextDirection = "right";
        
                    break;
                case "right":
                    $y++;
                    $nextDirection = "down";
        
                    break;
                case "down":
                    $x++;
                    $nextDirection = "left";
        
                    break;
                case "left":
                    $y--;
                    $nextDirection = "up";
        
                    break;
            }
        
            if (! isset($tmpContent[$x][$y])) {
                $isIn = false;
                continue;
            }
        
            $nextCase = $tmpContent[$x][$y];
        
            if ($nextCase == "#") {
                if (isset($objectsHit[$x.$y.$nextDirection])) {
                    $total++;
                    break;
                }
                $objectsHit[$x.$y.$nextDirection] = "";
                $direction = $nextDirection;
            } else {
                $tmpGuardPosition['x'] = $x;
                $tmpGuardPosition['y'] = $y;
                $openedCase[$x."_".$y] = "";
            }
        }
        

    }
}

echo $total-1;