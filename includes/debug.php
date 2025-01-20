<?php

$shell = false;

function dump($data) {
    global $shell;
    if (! is_string($data)) {
        $data = var_export($data, true);
    }
    if ($shell) echo $data."\n";
    else echo '<pre>' . $data . '</pre>';
}


function dd($data) {
    global $shell;
    if (! is_string($data)) {
        $data = var_export($data, true);
    } 
    if ($shell) echo $data."\n";
    else echo '<pre>' . $data . '</pre>';
    exit;
}