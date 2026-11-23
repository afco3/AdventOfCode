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

        $sum = 0;
        foreach ($bits as $bit) {
            $sum += 10**$bit;
        }

        $buttons[$key] = $sum;
    }

    $joltages = explode(',', substr(explode('{', $machine)[1], 0, -1));
    
    $goal = 0;
    foreach ($joltages as $key => $joltage) {
        $goal += $joltage*(10**$key);
    }
    $joltages = $goal;

    $machines[] = [
        'lights' => $lights,
        'buttons' => $buttons,
        'joltages' => $joltages,
        'results' => [],
    ];
}

// dd($machines);


$total = 0;
foreach ($machines as $key => $machine) {
    $joltages = $machine['joltages'];
    $buttons = $machine['buttons'];

    // dump($joltages);

    rsort($buttons);

    // dump($buttons);

    $debug = "";

    $bestCount = 999999999;
    $count = 0;
    solve(0, $joltages, $buttons, 0, $count, $bestCount, $debug);

    dump($bestCount, true);

    continue;

    $combinaisons = array_fill(0, count($buttons), 0);

    $max = [];
    foreach ($buttons as $key => $button) {
        $max[$key] = (int) ($joltages/$button);
    }

    dump(array_product($max));
    dump(array_product($max)/677);

    $max = array_reverse($max);

    // dump($combinaisons);
    // dd($max);

    dump("---------------------------------");

    $i = 0;
    while ($i < array_product($max) && $i < 1000) {


        $combinaison = [];
        $tmp = $i;
        foreach ($max as $value) {
            if ($tmp/$value >= 1) {
                $combinaison[] = $value;
                $tmp -= $value;
            } else {
                $combinaison[] = $tmp%$value;
                $tmp -= $tmp%$value;
            }
        }

        dump($combinaison);
        
        $i++;
    }


    dump("---------------------------------");

    dump($combinaisons);
    dd($max);








    foreach ($buttons as $button) {
        dump($joltages);
        dump($button);
        dump((int) ($joltages/$button));
        dump($joltages%$button);

        $total += (int) ($joltages/$button);

        $joltages = $joltages%$button;
        
        dump("---------------------------------");
    }

    dd($total);
    continue;
    for ($i = 1; $i < max($machine['joltages'])**count($machine['buttons']); $i++) {
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

dd($total);

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


function solve($state, $goal, $buttons, $index, &$count, &$bestCount, &$debug) {
    // dump("-------------------------------");
    // dump("state : " . $state);
    // dump("index : " . $index);
    // dump("count : " . $count);
    // dump("bestCount : " . $bestCount);
    // dump($debug);
    // dump("-------------------------------");

    if ($count >= $bestCount) return false;

    if ($state > $goal) return false;
    if ($state == $goal) {
        if ($count < $bestCount) $bestCount = $count;
        return true;
    }
    
    for ($i = $index; $i < count($buttons); $i++) {
        $tmp = $debug;
        $debug .= "+".$buttons[$i];

        $count++;
        solve($state+$buttons[$i], $goal, $buttons, $i, $count, $bestCount, $debug);

        $count--;
        $debug = $tmp;
    }

    // if (isset($buttons[$index+1])) {

    //     $debug .= "+".$buttons[$index+1];
    //     $count++;
    //     $return = solve($state+$buttons[$index+1], $goal, $buttons, $index+1, $count, $bestCount, $debug);
    //     $count--;
    //     $debug = $tmp;
    // }

    return ;
}


// function solve($state, $buttons, $index, &$count) {
//     if ($state == 0) return true;

//     $button = $buttons[$index];
    
//     if ($state < $button) {
//         if (! isset($buttons[$index+1])) return false;

//         return solve($state, $buttons, $index++, $count);
//     }

//     $count++;
//     return solve($state-$button, $buttons, $index, $count);
// }
