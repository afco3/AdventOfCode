<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$_machines = explode("\n", $content);

$machines = [];
foreach ($_machines as $machine) {
    $lights = substr(explode(']', $machine)[0], 1);
    $lights = str_replace(['.', '#'], ["0", "1"], $lights);
    
    $buttons = explode(' ', (trim(explode(']', explode('{', $machine)[0])[1])));
    foreach ($buttons as $key => $button) {
        $bits = explode(',', substr($button, 1, -1));

        $button = array_fill(0, strlen($lights), '0');

        foreach ($bits as $bit) {
            $button[$bit] = '1';
        }

        $buttons[$key] = implode('', $button);
    }

    $joltages = explode(',', substr(explode('{', $machine)[1], 0, -1));

    $machines[] = [
        'lights' => $lights,
        'buttons' => $buttons,
        'joltages' => $joltages,
        'results' => [],
    ];
}

// dd($machines);



foreach ($machines as $key => $machine) {
    for ($i = 1; $i < 2**count($machine['buttons']); $i++) {
        $light = str_replace('1', '0', $machine['lights']);
        $sequence = str_pad(decbin($i), count($machine['buttons']), '0', STR_PAD_LEFT);

        $buttonToPush = array_filter(str_split($sequence));

        foreach ($buttonToPush as $button => $state) {
            $light = strxor($light, $machine['buttons'][$button]);
        }

        if ($light === $machine['lights']) {
            $machines[$key]['results'][] = count($buttonToPush);
        }
    }
}

$total = 0;
foreach ($machines as $machine) {
    $results = $machine['results'];

    sort($results);

    $total += $results[0];
}
dd($total);



function strxor($b1, $b2) {
    return str_pad(decbin(bindec($b1) ^ bindec($b2)), strlen($b1), '0', STR_PAD_LEFT);
}