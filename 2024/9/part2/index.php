<?php
set_time_limit(3600);
include "../../../includes/debug.php";

$content = file_get_contents("./input.txt");

$partition = [];

$id = 0;
$emptyPlace = false;
foreach (str_split($content) as $num) {
    if ($emptyPlace) {
        $partition = array_merge($partition, [['size' => (int) $num, 'value' => "."]]);
    } else {
        $partition = array_merge($partition, [['size' => (int) $num, 'value' => $id]]);
        $id ++;
    }

    $emptyPlace = !$emptyPlace;
}

// displayPartition($partition);


$tmpPartition = $partition;
$i=0;
while (true) {
    // if ($i>=6) dd($partition);
    // $i++;
    if (empty($tmpPartition)) break;
    $fileKey = count($tmpPartition);
    $file = array_pop($tmpPartition);
    if (! isset($file['value']) || $file['value'] == ".") continue;
    
    $freeSpaceKey = array_find_key($partition, function ($space) use ($file) {
        return $space['value'] == "." && $space['size'] >= $file['size'];
    });

    // dump($fileKey);
    // dump($file);
    // dump($freeSpaceKey);

    if (is_null($freeSpaceKey)) continue;
    displayPartition($partition);

    array_splice($partition, $freeSpaceKey, 0, [$file]);
    array_splice($tmpPartition, $freeSpaceKey, 0, [$file]);

    $partition[$freeSpaceKey+1]['size'] = $partition[$freeSpaceKey+1]['size'] - $file['size'];
    // dump($partition);
    unset($partition[$fileKey]);

    $partition = array_values($partition);

    $firstFreeSpace = array_find_key($partition, function ($space) {
        return $space['value'] == "." && $space['size'] > 0;
    });
    
    dump($firstFreeSpace);
    dump($fileKey);

    if ($firstFreeSpace > $fileKey) break;
}

// dump($partition);


$finalpartition = [];

foreach ($partition as $file) {
    $finalpartition = array_merge($finalpartition, array_fill(0, $file['size'], $file['value']));
}

dump(implode('', $finalpartition));

$total = 0;
foreach (array_values($finalpartition) as $key => $num) {
    if ($num == '.') continue;
    $total += ($key*$num);
}

dd($total);


// 24453448462796  too high





function displayPartition($partition) {
    $finalpartition = [];

    foreach ($partition as $file) {
        $finalpartition = array_merge($finalpartition, array_fill(0, $file['size'], $file['value']));
    }

    dump(implode('', $finalpartition));
}
