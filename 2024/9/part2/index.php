<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$partition = [];

$id = 0;
$emptyPlace = false;
$key = 0;
foreach (str_split($content) as $num) {
    if ($emptyPlace) {
        $partition = array_merge($partition, [['key' => $key, 'size' => (int) $num, 'value' => "."]]);
    } else {
        $partition = array_merge($partition, [['key' => $key, 'size' => (int) $num, 'value' => $id]]);
        $id ++;
    }

    $key += $num;

    $emptyPlace = !$emptyPlace;
}

displayPartition($partition);

$reversePartition = array_reverse($partition);

foreach ($reversePartition as $space) {
    dump($space['key']);
    if ($space['value'] == '.' || $space['size'] == 0) continue;

    $partition = array_reverse($reversePartition);

    $newSpace = array_find($partition, function ($s) use ($space) {
        return $s['value'] == '.' && $s['size'] >= $space['size'];
    });

    if (is_null($newSpace) || $newSpace['key'] > $space['key']) continue;
    
    
    $spaceKey = array_find_key($reversePartition, function ($s) use ($space) {
        return $s['key'] === $space['key'];
    });

    $reversePartition[$spaceKey]['value'] = '.';

    $newSpaceKey = array_find_key($reversePartition, function ($s) use ($newSpace) {
        return $s['key'] == $newSpace['key'];
    });

    array_splice($reversePartition, $newSpaceKey+1, 0, [$space]);

    $reversePartition[$newSpaceKey]['size'] -= $space['size'];

    $reversePartition[$newSpaceKey+1]['key'] = $reversePartition[$newSpaceKey+2]['key'] + $reversePartition[$newSpaceKey+2]['size'];

    $reversePartition[$newSpaceKey]['key'] = $reversePartition[$newSpaceKey+1]['key'] + $reversePartition[$newSpaceKey+1]['size'];
}

$partition = array_reverse($reversePartition);

$finalpartition = [];

foreach ($partition as $file) {
    for ($i = 0; $i < $file['size']; $i++) {
        $finalpartition[] = $file['value'];
    }
}

$total = 0;
foreach (array_values($finalpartition) as $key => $num) {
    if ($num == '.') continue;
    $total += ($key*$num);
}

dd($total);


function displayPartition($partition) {
    $finalpartition = [];

    foreach ($partition as $file) {
        $finalpartition = array_merge($finalpartition, array_fill(0, $file['size'], $file['value']));
    }

    dump(implode('', $finalpartition));
}
