<?php
set_time_limit(3600*24);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$program = explode(',', explode(': ', $content[3])[1]);

dump(implode(',', $program));

$ATest = pow(8,16); // 14050719186

$A = $B = $C = 0;

// for ($i = pow(8, 0); $i <= pow(8, 1); $i++) {
//     $A = $i;
//     $output = findOutput($A, $B, $C, $program);

//     dump($i.' : '.implode(',', $output));
// }

// dump('---------------------');

// $A=0;
// while (true) {
//     $result = ((6^(5^($A%8)))^ (int) ($a/(5^($A%8))))%8;
//     $A++;
// }

// for ($i = 0; $i < 8; $i++) {
//     $output = findOutput((3*8)+$i, 0, 0, $program);
//     dump(implode(',', $output));
// }

$results = [];
$newPoss = [];
$poss = [0,1,2,3,4,5,6,7,8];
for ($i = 0; $i < 16; $i++) {
    for ($j = 0; $j < 8; $j++) {
        foreach ($poss as $p) {
            $output = findOutput(($p*8)+$j, 0, 0, $program);
            dump((($p*8)+$j) . ' : '. implode(',', $output));

            if (strpos(implode(',', $program), implode(',', $output)) && (($p*8)+$j) < pow(8, 16)) {
                $newPoss[] = ($p*8)+$j;
            }

            if (implode(',', $program) === implode(',', $output)) {
                $results[] = ($p*8)+$j;
            }
        }
    }
    $poss = $newPoss;
    $newPoss = [];
}

sort($results);
dd($results[0]);

// $output = findOutput((((((3*8*8*8)+2)*8)+2)*8)+17, 0, 0, $program);
// dump(implode(',', $output));


dd('exit');

function findOutput($A, $B, $C, $program) {
    $pointer = 0;
    $output = [];

    while (isset($program[$pointer])) {
        $instruction = (int) $program[$pointer];
        $operand = (int) $program[$pointer+1];
        
        switch ($operand) {
            case 0:
            case 1:
            case 2:
            case 3:
                $comboOperand = $operand;
                break;
            case 4:
                $comboOperand = $A;
                break;
            case 5:
                $comboOperand = $B;
                break;
            case 6:
                $comboOperand = $C;
                break;
        }

        switch ($instruction) {
            case 0:
                $A = (int) ($A/pow(2, $comboOperand));
                break;
            case 1:
                $B = $operand^$B;
                break;
            case 2:
                $B = $comboOperand%8;
                break;
            case 3:
                if ($A == 0) break;

                $pointer = $operand - 2;
                
                break;
            case 4:
                $B = $B^$C;
                break;
            case 5:
                $output[] = $comboOperand%8;
                break;
            case 6:
                $B = (int) ($A/pow(2, $comboOperand));
                break;
            case 7:
                $C = (int) ($A/pow(2, $comboOperand));
                break;
        }

        $pointer+=2;
    }

    return $output;
}



dump($ATest);
dump(implode(',', $output));
dd($content);


function displayContent($content) {
    foreach ($content as $k => $v) {
        $content[$k] = implode('', $v);
    }

    dump(implode("\n", $content));
}