<?php
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$total = 0;

foreach ($content as $line) {
    [$result, $values] = explode(": ", $line);
    $values = explode(" ", $values);

    $operators = array_fill(0, count($values)-1, '+');

    $numOp = 0;
    while (true) {
        $bin = base_convert($numOp, "10", "3");
        if (strlen($bin) > count($values)-1) break;

        $bin = str_pad($bin, count($values)-1, "0", STR_PAD_LEFT);
        // dump($bin);

        $operators = str_replace(["0", "1", "2"], ["+", "*", "|"], $bin);
        $operators = str_split($operators);
        // dump($operators);

        $count = $values[0];
        for ($k = 1; $k < count($values); $k++) {
            $op = $operators[$k-1];
            $v = $values[$k];
            switch ($op) {
                case "+":
                    $count += $v;
                    break;
                case "*":
                    $count *= $v;
                    break;
                case "|":
                    $count .= $v;
                    break;
            }
        }

        // $calc = str_repeat("(", count($values));
        // for ($k = 0; $k < count($values); $k++) {
        //     $calc .= $values[$k].")".($operators[$k] ?? "");
        // }

        // $count = eval("return ".$calc.";");


        if ($count == $result) {
            $total += $count;
            break;
        }


        $numOp++;
    }

}

echo $total;