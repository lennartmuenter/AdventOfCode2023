<?php
$before = microtime(true);

$file = file("5.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

preg_match('/^seeds\:\s([\d\s]+)$/', $file[0], $matches);
$seeds = array_map(function ($i) {
    return intval($i);
}, explode(' ', $matches[1]));
unset($file[0]);

$steps = [];
$key = '';
$smallest = -1;
$largest = -1;

foreach ($file as $line) {
    if (preg_match('/(\d+\s?)+/', $line)) {
        // number
        $numbers = array_map(function ($i) {
            return intval($i);
        }, explode(' ', $line));
        $numbers = [
            'add' => $numbers[0] - $numbers[1],
            'from' => $numbers[1],
            'to' => $numbers[1] + $numbers[2] - 1,
        ];
        if ($numbers['from'] < $smallest || $smallest == -1) {
            $smallest = $numbers['from'];
        }
        if ($numbers['to'] > $largest || $largest == -1) {
            $largest = $numbers['to'];
        }
        $steps[$key][] = $numbers;
        $steps[$key]['from'] = $smallest;
        $steps[$key]['to'] = $largest;
    } else {
        preg_match('/to-(.*?)\s+map/', $line, $matches);
        $key = $matches[1];
        $smallest = -1;
        $largest = -1;
    }
}

$smallest = -1;
$count = 0;
for ($i = 0; $i < count($seeds); $i += 2) {
    $rangeStart = $seeds[$i];
    $rangeEnd = $rangeStart + ($seeds[$i + 1]);
    for ($seed = $rangeStart; $seed < $rangeEnd; $seed++) {
        $result = $seed;
        foreach ($steps as $step) {
            if ($result < $step['from'] || $result > $step['to']) {
                continue;
            }
            foreach ($step as $mission) {
                if (!is_array($mission)) {
                    continue;
                }
                if ($result >= $mission['from'] && $result <= $mission['to']) {
                    $result += $mission['add'];
                    break;
                }
            }
        }
        if ($result < $smallest || $smallest === -1) {
            $smallest = $result;
            var_dump($smallest);
            echo number_format(((microtime(true) - $before) * 1000000), 0, '', '') . ' microseconds runtime' . PHP_EOL;
        }
    }
}

var_dump($smallest);

echo number_format(((microtime(true) - $before) * 1000000), 0, '', '') . ' microseconds runtime' . PHP_EOL;

// Runtime: Canceled after 1h 15 minutes. BUT it found the correct value after 8:20 Minutes.