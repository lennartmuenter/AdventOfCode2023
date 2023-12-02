<?php

$file = fopen("Day1.txt", "r");

$count = 0;

while ($line = fgets($file)) {
    $line = str_split(preg_replace("~\D~", "", $line));
    $line = $line[0] . $line[count($line) - 1];
    $line = intval($line);
    $count += $line;
}

var_dump($count);

fclose($file);
