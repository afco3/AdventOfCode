<?php

$content = file_get_contents("./input.txt");

echo substr_count($content, '(') - substr_count($content, ')');