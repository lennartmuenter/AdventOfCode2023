<?php
$file = file("Day2.txt");

$count = 0;

foreach ($file as $line) {
    $rounds = preg_split('/[:;]+/', str_replace(' ', '', $line));
    $id = intval(preg_replace('~\D~', '', $rounds[0]));
    unset($rounds[0]);
    foreach ($rounds as $round) {
        $part = preg_split('/[,]+/', $round);
        $round = [
            'red' => 0,
            'green' => 0,
            'blue' => 0,
        ];
        foreach ($part as $string) {
            $round[trim(preg_replace('/\d/', '', $string))] += preg_replace('~\D~', '', $string);
        }
        if (($round['red'] > 12 || $round['green'] > 13 || $round['blue'] > 14)) {
            $id = 0;
        }
    }
    $count += $id;
}

var_dump($count);