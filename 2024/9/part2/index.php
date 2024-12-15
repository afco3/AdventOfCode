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

// dump($partition);
// dd($reversePartition);

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

    // if ($space['value'] == 2) {
    //     dump($space);
    //     dump($newSpace);
    //     dump($spaceKey);
    //     dump($reversePartition);
    //     dump($reversePartition[$spaceKey]);
    // }

    $reversePartition[$spaceKey]['value'] = '.';
    // if ($space['value'] == 2) {
    //     dump($reversePartition[$spaceKey]);
    // }

    $newSpaceKey = array_find_key($reversePartition, function ($s) use ($newSpace) {
        return $s['key'] == $newSpace['key'];
    });

    // if ($space['value'] == 2) {
    //     dump($newSpaceKey);

    //     dump($reversePartition);
    // }

    array_splice($reversePartition, $newSpaceKey+1, 0, [$space]);

    // if ($space['value'] == 2) {
    //     dump($reversePartition);
    // }

    $reversePartition[$newSpaceKey]['size'] -= $space['size'];

    
    // if ($space['value'] == 2) {
    //     dump($reversePartition);
    // }

    $reversePartition[$newSpaceKey+1]['key'] = $reversePartition[$newSpaceKey+2]['key'] + $reversePartition[$newSpaceKey+2]['size'];

    $reversePartition[$newSpaceKey]['key'] = $reversePartition[$newSpaceKey+1]['key'] + $reversePartition[$newSpaceKey+1]['size'];

    
    // if ($space['value'] == 2) {
    //     dump($reversePartition);
    // }

    // displayPartition(array_reverse($reversePartition));
    
    // if ($space['value'] == 2) {
    //     dd("");
    // }
}

$partition = array_reverse($reversePartition);

$finalpartition = [];

foreach ($partition as $file) {
    for ($i = 0; $i < $file['size']; $i++) {
        $finalpartition[] = $file['value'];
    }
    // $finalpartition = array_merge($finalpartition, array_fill(0, $file['size'], $file['value']));
}

// dump(implode('', $finalpartition));

$total = 0;
foreach (array_values($finalpartition) as $key => $num) {
    if ($num == '.') continue;
    $total += ($key*$num);
}

dd($total);


// 24453448462796  too high

// 13820373322856  too high

// 18880851835397  too high



function displayPartition($partition) {
    $finalpartition = [];

    foreach ($partition as $file) {
        $finalpartition = array_merge($finalpartition, array_fill(0, $file['size'], $file['value']));
    }

    dump(implode('', $finalpartition));
}
