<pre>
<?php

$content = file_get_contents("./input.txt");

$content = explode("\n", $content);

$fromCities = [];
$toCities = [];
$flies = [];
foreach ($content as $fly) {
    $fly = explode(" ", $fly);
    $flies[] = [
        'from' => $fly[0],
        'to' => $fly[2],
        'dist' => $fly[4],
    ];
    $fromCities[$fly[0]] = $fly[0];
    $toCities[$fly[2]] = $fly[2];
}
$cities = array_merge($fromCities, $toCities);

$from = array_diff($fromCities, $toCities);
$to = array_diff($toCities, $fromCities);
$total = [];

$fliesTo = getFlies($flies, null, $to);
foreach ($fliesTo as $fly) {
    $total[] = [
        'cities' => [$to, $fly['from']],
        'dist' => $fly['dist'],
    ];
}

foreach ($total as $journey) {

}

echo $total;

// var_dump($flies);
// var_dump(array_search("AlphaCentauri", array_column($flies, 'from')));

// var_dump(array_splice($flies, array_search("AlphaCentauri", array_column($flies, 'from')))[0]);

// var_dump($flies);

// echo $total;


function getFlies($flies, $from, $to = null) {
    $return = [];
    foreach ($flies as $fly) {
        if (is_null($to) && $fly['from'] == $from){
            $return[] = $fly;
        }

        if (is_null($from) && $fly['to'] == $to){
            $return[] = $fly;
        }
    }
    return $return;
}

?>
</pre>