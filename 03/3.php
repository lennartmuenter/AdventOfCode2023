<?php
$file = file("3.txt");

$numbercords = [];
$specialcords = [];
$countPart1 = 0;
$countPart2 = 0;

foreach ($file as $y => $line) {
    $file[$y] = $line = str_split(trim($line));
    $number = '';
    foreach ($line as $x => $char) {
        if (is_numeric($char) === true && $x != count($line) - 1) {
            $number .= $char;
        } else if (strlen($number) > 0) {
            $number .= $char;
            $numbercords[] = [
                'val' => intval($number),
                'x_start' => ($x - strlen($number)) < 0 ? 0 : ($x - strlen($number)),
                'y_start' => ($y - 1) < 0 ? 0 : ($y - 1),
                'x_end' => $x >= count($line) ? $x - 1 : $x,
                'y_end' => $y + 1 >= count($file) ? $y : $y + 1,
            ];
            $number = '';
        }
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $char) || $char == '/') {
            $specialcords[] = [
                'val' => $char,
                'x' => $x,
                'y' => $y,
            ];
        }
    }
}

foreach ($specialcords as $special) {
    $adj = [];
    foreach ($numbercords as $number) {
        if ($special['y'] >= $number['y_start'] && $special['y'] <= $number['y_end']) {
            if ($special['x'] >= $number['x_start'] && $special['x'] <= $number['x_end']) {
                $countPart1 += $number['val'];
                ($special['val'] == '*') ? ($adj[] = $number['val']) : null;
            }
        }
    }
    (count($adj) == 2) ? ($countPart2 += array_product($adj)) : null;
}

var_dump($countPart1);
var_dump($countPart2);