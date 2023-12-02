<?php
$file = file("Day2.txt");

$count = 0;

foreach ($file as $line) {
    $rounds = preg_split('/[:;]+/', str_replace(' ', '', $line));
    $id = intval(preg_replace('~\D~', '', $rounds[0]));
    unset($rounds[0]);
    $fewest = [
        'red' => 1,
        'green' => 1,
        'blue' => 1,
    ];
    foreach ($rounds as $round) {
        $part = preg_split('/[,]+/', $round);
        foreach ($part as $string) {
            $name = trim(preg_replace('/\d/', '', $string));
            $value = preg_replace('~\D~', '', $string);
            $value > $fewest[$name] ? $fewest[$name] = $value : null;
        }
    }
    $count += array_product($fewest);
}

var_dump($count);