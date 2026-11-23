<?php

$content = file_get_contents("./input.txt");

$count = 0;
foreach(str_split($content) as $key => $char){
    $count = $char === "(" ? $count+1 : $count-1;
    if($count === -1){
        echo $key +1;
        exit;
    }
}