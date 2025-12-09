<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$boxes = explode("\n", $content);

foreach ($boxes as $key => $box) {
    $boxes[$key] = explode(',', $box);
}

// dd($boxes);

$circuits = [];

for ($i=0; $i < 10; $i++) {
    for ($j=0; $j < count($boxes); $j++) {
        $box = $boxes[$j];
        $min = 99999999999;
        $box2 = null;
        for ($k=0; $k < count($boxes); $k++) {
            $tmp = $boxes[$k];
            if ($box === $tmp) continue;
            $dx = abs($box[0]-$tmp[0]);
            $dy = abs($box[1]-$tmp[1]);
            $dz = abs($box[2]-$tmp[2]);
            $d = sqrt($dx**2 + $dy**2 + $dz**2);

            if ($min > $d) {
                $min = $d;
                $box2 = $tmp;
            }
        }

        $isNew = true;
        foreach ($circuits as $key => $circuit) {
            if (in_array($box, $circuit)) {
                $circuits[$key][] = $box2;
                $isNew = false;
            } else if (in_array($box2, $circuit)) {
                $circuits[$key][] = $box;
                $isNew = false;
            }
        }
        if ($isNew) {
            $circuits[] = [$box, $box2];
        }
    }
}

foreach ($circuits as $key => $circuit) {
    dump($key . " " . count($circuit));
}

dd($circuits);