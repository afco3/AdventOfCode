<?php

$content = file_get_contents("./input");

$content = preg_replace("/[a-zA-Z]/", "", $content);

$content = preg_split("/[^0-9]/", $content);

$total = 0;
foreach($content as $number){
    $total += (int) (substr($number, 0, 1) . substr($number, -1));
}

echo $total;