<?php

function dump($data) {
    echo '<pre>' . var_export($data, true) . '</pre>';
}


function dd($data) {
    echo '<pre>' . var_export($data, true) . '</pre>';
    exit;
}