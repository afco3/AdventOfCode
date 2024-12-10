<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$total = 0;

foreach ($content as $line) {
    [$result, $values] = explode(": ", $line);
    $values = explode(" ", $values);

    $operators = array_fill(0, count($values)-1, '+');

    $count = array_sum($values);
    
    if ($count == $result) {
        $total += $count;
        continue;
    }

    for ($i = 0; $i < count($operators); $i++) {
        for ($j = $i; $j < count($operators); $j++) {
            $tmpOperators = $operators;
            $tmpOperators[$j] = '*';
            // dump($tmpOperators);

            $calc = "";
            for ($k = 0; $k < count($values); $k++) {
                $calc .= $values[$k].($tmpOperators[$k] ?? "");
            }

            $count = eval("return ".$calc.";");

            if ($count == $result) {
                $total += $count;
                continue 3;
            }
        }

        $operators[$i] = '*';
    }

}

echo $total;