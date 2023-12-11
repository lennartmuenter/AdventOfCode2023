<?php
$before = microtime(true);

$file = file("5.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

preg_match_all('!\d+!', $file[0], $matches);

$seeds = $matches[0];

unset($file[0]);

$key = '';

foreach($file as $line){
    if(is_numeric(str_replace(' ', '', $line)) === false) {
        $key = explode(' ', str_replace('-to-', ' ', str_replace(' map:', '', $line)));
        $key = $key[1];
    } else {
        preg_match_all('!\d+!', $line, $names);
        $steps[$key][] = $names[0];
    }
}

for($i = 0; $i < count($seeds); $i++){
    foreach($steps as $name => $step){
        foreach($step as $values){
            if($seeds[$i] >= $values[1] && $seeds[$i] < $values[1] + $values[2]){
                $seeds[$i] = $values[0] + ($seeds[$i] - $values[1]);
                break;
            }
        }
    }
}
var_dump(min($seeds));

$after = microtime(true);
echo number_format((($after-$before) * 1000000), 0, '', '') .' microseconds runtime'.PHP_EOL;