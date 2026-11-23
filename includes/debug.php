<?php
set_time_limit(3600);

$shell = false;

function dump($data, $flush=false) {
    global $shell;
    if (! is_string($data)) {
        $data = var_export($data, true);
    }
    if ($shell) echo $data."\n";
    else echo '<pre>' . $data . '</pre>';

    if ($flush) ob_flush();
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

function display($a) {
    foreach ($a as $k => $v) {
        if (is_array($v)) $content[$k] = implode('', $v);
    }

    dump(implode("\n", $content));
}