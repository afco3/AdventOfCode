<?php
set_time_limit(3600*24);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$program = explode(',', explode(': ', $content[3])[1]);

dump(implode(',', $program));

$output = [];
$ATest = 35184462794505; // 14050719186
while (implode(',', $output) != $program) {
    $A = $ATest;
    $B = 0;
    $C = 0;

    
    if ($ATest > 106069203429786) dd('exit');

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

        if (count($output) > 8 && strpos(implode(',', $program), implode(',', $output)) !== 0) {
            array_pop($output);
            dump($ATest.' -> '.implode(',', $output));
            $ATest++;
            continue 2;
        }
    }
    $ATest++;
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