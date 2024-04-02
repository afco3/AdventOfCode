<?php

$numberMapping = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
    'five' => 5,
    'six' => 6,
    'seven' => 7,
    'eight' => 8,
    'nine' => 9,
];

$content = file_get_contents("./input");

$content = preg_split("/[\s]+/", $content);

$total = 0;
foreach($content as $key => $number){
    // echo (int) (substr($number, 0, 1) . substr($number, -1));
    // echo "<br />";
    // echo $number;
    // echo "<br>";
    echo $number;
    echo "<br>";
    preg_match_all("/(one|two|three|four|five|six|seven|eight|nine)/", $number, $matches);
    // foreach ($matches[0] as $match) {
    //     $number = preg_replace('/'.$match.'/', $numberMapping[$match], $number, 1);
    // }
    if(isset($matches[0][0])){
        $number = preg_replace('/'.$matches[0][0].'/', $numberMapping[$matches[0][0]], $number, 1);
        $number = preg_replace('/'.end($matches[0]).'/', $numberMapping[end($matches[0])], $number, 1);
    }
    echo $number;
    echo "<br>";
    
    $number = preg_replace("/[a-zA-Z]/", "", $number);
    echo $number;
    echo "<br>";
    echo (int) (substr($number, 0, 1) . substr($number, -1));
    echo "<br>";
    echo "<br>";
    $total += (int) (substr($number, 0, 1) . substr($number, -1));
}

echo $total;