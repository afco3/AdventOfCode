<?php

function dump($data) {
    if (! is_string($data)) {
        $data = var_export($data, true);
    } 
    echo '<pre>' . $data . '</pre>';
}


function dd($data) {
    if (! is_string($data)) {
        $data = var_export($data, true);
    } 
    echo '<pre>' . $data . '</pre>';
    exit;
}