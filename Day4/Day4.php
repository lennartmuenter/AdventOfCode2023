<?php
$before = microtime(true);
$file = file("Day4.txt");

$pointsCount = 0;
$cardCount = [];

foreach ($file as $key => $line) {
    $ticket = preg_split('/[:|]+/', trim($line));
    $ticket[1] = explode(' ', str_replace('  ', ' ', trim($ticket[1])));
    $ticket[2] = explode(' ', str_replace('  ', ' ', trim($ticket[2])));
    $wonCount = count(array_intersect($ticket[2], $ticket[1]));
    if($wonCount > 1){
        $pointsCount += (2 ** ($wonCount - 1));
    } else {
        $pointsCount += $wonCount;
    }
    $cardCount[$key]['val'] = 1;
    $cardCount[$key]['won'] = $wonCount;
}

for ($am = 0; $am < count($cardCount); $am++) {
    for ($i = 1; $i <= $cardCount[$am]['won']; $i++) {
        $cardCount[$am + $i]['val'] += $cardCount[$am]['val'];
    }
    $cardCount[$am] = $cardCount[$am]['val'];
}

var_dump($pointsCount);
var_dump(array_sum($cardCount));

$after = microtime(true);
echo number_format((($after-$before) * 1000000), 0, '', '') .' microseconds runtime'.PHP_EOL;