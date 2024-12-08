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

$direction = "up";

$openedCase = [];
$isIn = true;
while($isIn) {
    $x = $guardPosition['x'];
    $y = $guardPosition['y'];
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

    if (! isset($content[$x][$y])) {
        $isIn = false;
        continue;
    }

    $nextCase = $content[$x][$y];

    if ($nextCase == "#") {
        $direction = $nextDirection;
    } else {
        $guardPosition['x'] = $x;
        $guardPosition['y'] = $y;
        $openedCase[$x."_".$y] = "";
    }
}

echo count($openedCase);