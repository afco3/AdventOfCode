<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

dd($content);



function displayContent($content) {
    foreach ($content as $k => $v) {
        $content[$k] = implode('', $v);
    }

    dump(implode("\n", $content));
}